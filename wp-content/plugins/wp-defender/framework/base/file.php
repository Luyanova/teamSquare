<?php
/**
 * Author: Hoang Ngo
 */

namespace Calotes\Base;

class File {
	const ENGINE_SPL = 'spl', ENGINE_SCANDIR = 'scan_dir', ENGINE_OPENDIR = 'open_dir';

	/**
	 * Engine use to create a dir tree
	 *
	 * @var string
	 */
	public $engine = '';

	/**
	 * Absolute path to a folder need to create a dir tre
	 *
	 * @var string
	 */
	public $path = '';

	/**
	 * Is the result including file?
	 *
	 * @var bool
	 */
	public $include_file = true;

	/**
	 * Is the result include dir
	 *
	 * @var bool
	 */
	public $include_dir = true;

	/**
	 * @var bool
	 */
	public $include_hidden = false;

	/**
	 * This is where to define the rules for exclude files out of the result
	 *
	 * 'ext'=>array('jpg','gif') file extension you don't want appear in the result
	 * 'path'=>array('/tmp/file1.txt','/tmp/file2') absolute path to files
	 * 'dir'=>array('/tmp/','/dir/') absolute path to the directory you dont want to include files
	 * 'filename'=>array('abc*') file name you don't want to include, can be regex,
	 *
	 * @var array
	 */
	public $exclude = [];

	/**
	 * This is where to define the rules for include files, please note that if $include is provided, the $exclude
	 * will get ignored
	 *
	 * 'ext'=>array('jpg','gif') file extension you don't want appear in the result
	 * 'path'=>array('/tmp/file1.txt','/tmp/file2') absolute path to files
	 * 'dir'=>array('/tmp/','/dir/') absolute path to the directory you dont want to include files
	 * 'filename'=>array('abc*') file name you don't want to include, can be regex.
	 *
	 * @var array
	 */
	public $include = [];

	/**
	 * Does this search recursive
	 *
	 * @var bool
	 */
	public $is_recursive = true;

	/**
	 * if provided, only search file smaller than this
	 *
	 * @var bool
	 */
	public $max_filesize = false;

	/**
	 * @param $path
	 * @param bool|true  $include_file
	 * @param bool|false $include_dir
	 * @param array      $include
	 * @param array      $exclude
	 * @param bool|true  $is_recursive
	 * @param bool|int   $max_filesize
	 */
	public function __construct( $path, $include_file = true, $include_dir = false, $include_rules = [], $exclude = [], $is_recursive = true, $include_hidden = false, $max_filesize = false ) {
		$this->path = $path;
		$this->include_file = $include_file;
		$this->include_dir = $include_dir;
		$this->include = $include_rules;
		$this->exclude = $exclude;
		$this->is_recursive = $is_recursive;
		$this->engine = self::ENGINE_SCANDIR;
		$this->include_hidden = $include_hidden;
		$this->max_filesize = $max_filesize;
	}

	/**
	 * @return array
	 */
	public function get_dir_tree() {
		$result = [];
		if ( ! is_dir( $this->path ) ) {
			return $result;
		}

		if ( self::ENGINE_SPL === $this->engine ) {
			$result = $this->_get_dir_tree_by_spl();
		} elseif ( self::ENGINE_SCANDIR === $this->engine ) {
			$result = $this->_get_dir_tree_by_scandir();
		} elseif ( self::ENGINE_OPENDIR === $this->engine ) {
			$result = $this->_get_dir_tree_by_open_dir();
		}

		return $result;
	}

	/**
	 * Create a dir tree by SPL library
	 *
	 * @return array
	 */
	private function _get_dir_tree_by_spl() {
		$path = $this->path;
		$data = [];
		if ( $this->is_recursive ) {
			$directory_flag = \FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::CURRENT_AS_FILEINFO
							| \FilesystemIterator::UNIX_PATHS | \FilesystemIterator::SKIP_DOTS;
			$directory = new \RecursiveDirectoryIterator( $path, $directory_flag );

			if ( ! empty( $this->include ) || ! empty( $this->exclude ) ) {
				$directory = new \RecursiveCallbackFilterIterator(
					$directory,
					[
						&$this,
						'filter_directory',
					]
				);
			}
			$tree = new \RecursiveIteratorIterator( $directory, \RecursiveIteratorIterator::SELF_FIRST );
			if ( true !== $this->is_recursive ) {
				$tree->setMaxDepth( $this->is_recursive );
			}
		} else {
			$tree = new \FilesystemIterator( $path );
		}

		foreach ( $tree as $file ) {
			$real_path = $file->getRealPath();

			$is_hidden = explode( DIRECTORY_SEPARATOR . '.', $real_path );
			if ( count( $is_hidden ) > 1 && false === $this->include_hidden ) {
				continue;
			}
			if ( false === $this->is_recursive ) {
				// Have to filter this, for un recursive.
				if ( ! empty( $this->include ) || ! empty( $this->exclude ) ) {
					if ( false === $this->filter_directory( $real_path ) ) {
						continue;
					}
				}
			}

			if ( false === $this->include_file && $file->isFile() ) {
				continue;
			}

			if ( false === $this->include_dir && $file->isDir() ) {
				continue;
			}

			if ( $file->isFile() && is_numeric( $this->max_filesize ) ) {
				// Convert max to bytes.
				$max_size = $this->max_filesize * ( pow( 1024, 2 ) );
				if ( $file->getSize() > $max_size ) {
					continue;
				}
			}

			$data[] = $real_path;
		}

		return $data;
	}

	/**
	 * @param $path
	 *
	 * @return array
	 */
	private function _get_dir_tree_by_scandir( $path = null ) {
		if ( is_null( $path ) ) {
			$path = $this->path;
		}
		$path = rtrim( $path, DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR;
		$rfiles = scandir( $path );
		$data = [];

		foreach ( $rfiles as $rfile ) {
			if ( '.' === $rfile || '..' === $rfile ) {
				continue;
			}
			if ( '.' === substr( pathinfo( $rfile, PATHINFO_BASENAME ), 0, 1 )
				&& false === $this->include_hidden ) {
				// Hidden files, move on.
				continue;
			}

			$real_path = $path . $rfile;

			$type = filetype( $real_path );

			if ( ( ! empty( $this->include ) || ! empty( $this->exclude ) ) && ( false === $this->filter_directory( $real_path, $type ) ) ) {
				continue;
			}

			if ( 'file' === $type && true === $this->include_file ) {
				if ( is_numeric( $this->max_filesize ) ) {
					$max_size = $this->max_filesize * ( pow( 1024, 2 ) );
					if ( filesize( $real_path ) > $max_size ) {
						continue;
					} else {
						$data[] = $real_path;
					}
				} else {
					$data[] = $real_path;
				}
			}

			if ( 'dir' === $type ) {
				if ( $this->include_dir ) {
					$data[] = $real_path;
				}
				if ( $this->is_recursive ) {
					$tdata = $this->_get_dir_tree_by_scandir( $real_path );
					$data = array_merge( $data, $tdata );
				}
			}
		}

		return $data;
	}

	/**
	 * Query files on path using opendir&readir
	 *
	 * @param $path
	 *
	 * @return array
	 * @since 1.0.5
	 */
	private function _get_dir_tree_by_open_dir( $path = null ) {
		if ( is_null( $path ) ) {
			$path = $this->path;
		}
		$path = rtrim( $path, DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR;
		$data = [];

		if ( $dh = opendir( $path ) ) {// phpcs:ignore
			while ( ( $file = readdir( $dh ) ) !== false ) {// phpcs:ignore
				if ( '.' === $file || '..' === $file ) {
					continue;
				}
				$real_path = $path . $file;
				if ( '.' === substr( pathinfo( $real_path, PATHINFO_BASENAME ), 0, 1 ) ) {
					// Hidden files, move on.
					continue;
				}

				if ( ( ! empty( $this->include ) || ! empty( $this->exclude ) ) && ( false === $this->filter_directory( $real_path ) ) ) {
					continue;
				}

				$type = filetype( $real_path );

				if ( 'file' === $type && true === $this->include_file ) {
					if ( is_numeric( $this->max_filesize ) ) {
						$max_size = $this->max_filesize * ( pow( 1024, 2 ) );
						if ( filesize( $real_path ) > $max_size ) {
							continue;
						} else {
							$data[] = $real_path;
						}
					} else {
						$data[] = $real_path;
					}
				}

				if ( 'dir' === $type ) {
					if ( $this->include_dir ) {
						$data[] = $real_path;
					}
					if ( $this->is_recursive ) {
						$tdata = $this->_get_dir_tree_by_open_dir( $real_path );
						$data  = array_merge( $data, $tdata );
					}
				}
			}
			closedir( $dh );
		}

		return $data;
	}

	/**
	 * Filter for recursive directory tree
	 *
	 * @param $current
	 * @param $filetype
	 *
	 * @return bool|void
	 */
	public function filter_directory( $current, $filetype = null ) {
		if ( ! empty( $this->include ) ) {
			return $this->_filter_include( $current, $filetype );
		} elseif ( ! empty( $this->exclude ) ) {
			return $this->_filter_exclude( $current, $filetype );
		}
	}

	/**
	 * @param $path
	 * @param $filetype
	 *
	 * @return bool
	 */
	private function _filter_include( $path, $filetype = null ) {
		$include = $this->include;
		$exclude = $this->exclude;
		$applied = 0;
		$dir_include = isset( $include['dir'] ) ? $include['dir'] : [];
		$dir_exclude = isset( $exclude['dir'] ) ? $exclude['dir'] : [];

		if ( ! is_null( $filetype ) ) {
			$type = $filetype;
		} else {
			$type = filetype( $path );
		}

		if ( is_array( $dir_include ) && count( $dir_include ) ) {
			if ( is_array( $dir_exclude ) ) {
				foreach ( $dir_exclude as $dir ) {
					if ( 0 === strpos( $path, $dir ) ) {
						// This mean, exlucde matched, we won't list this. Move to next loop.
						continue;
					}
				}
			}

			foreach ( $dir_include as $dir ) {
				if ( 0 === strpos( $path, $dir ) ) {
					return true;
				}
			}
			$applied++;// phpcs:ignore
		}

		// Next extension.
		$ext_include = isset( $include['ext'] ) ? $include['ext'] : [];

		if ( is_array( $ext_include ) && count( $ext_include ) && 'file' === $type ) {
			// We will uses foreach and strcasecmp instead of regex cause it faster.
			foreach ( $ext_include as $ext ) {
				if ( strcasecmp( pathinfo( $path, PATHINFO_EXTENSION ), $ext ) === 0 ) {
					// Match.
					return true;
				}
			}
			$applied++;// phpcs:ignore
		}

		// Now filename.
		$filename_include = isset( $include['filename'] ) ? $include['filename'] : [];
		if ( is_array( $filename_include ) && count( $filename_include ) && 'file' === $type ) {
			foreach ( $filename_include as $filename ) {
				if ( preg_match( '/' . $filename . '/', pathinfo( $path, PATHINFO_BASENAME ) ) ) {
					return true;
				}
			}
			$applied++;// phpcs:ignore
		}

		// Now abs path.
		$path_include = isset( $include['path'] ) ? $include['path'] : [];
		if ( is_array( $path_include ) && count( $path_include ) && 'file' === $type ) {
			foreach ( $path_include as $p ) {
				if ( strcmp( $p, $path ) === 0 ) {
					return true;
				}
			}
			$applied++;// phpcs:ignore
		}

		if ( 0 === $applied ) {
			return true;
		}

		return false;
	}

	/**
	 * Run the filter for a file/dir.
	 *
	 * @param $path
	 * @param $filetype
	 *
	 * @return bool
	 */
	private function _filter_exclude( $path, $filetype = null ) {
		$exclude = $this->exclude;
		// First filer dir, or file inside dir.
		if ( ! is_null( $filetype ) ) {
			$type = $filetype;
		} else {
			$type = filetype( $path );
		}
		$dir_exclude = isset( $exclude['dir'] ) ? $exclude['dir'] : [];
		if ( is_array( $dir_exclude ) && count( $dir_exclude ) ) {
			foreach ( $dir_exclude as $dir ) {
				if ( strpos( $path, $dir ) === 0 ) {
					return false;
				}
			}
		}

		// Next extension.
		$ext_exclude = isset( $exclude['ext'] ) ? $exclude['ext'] : [];
		if ( is_array( $ext_exclude ) && count( $ext_exclude ) && 'file' === $type ) {
			// We will uses foreach and strcasecmp instead of regex cause it faster.
			foreach ( $ext_exclude as $ext ) {
				if ( strcasecmp( pathinfo( $path, PATHINFO_EXTENSION ), $ext ) === 0 ) {
					// Match.
					return false;
				}
			}
		}
		// Now filename.
		$filename_exclude = isset( $exclude['filename'] ) ? $exclude['filename'] : [];
		if ( is_array( $filename_exclude ) && count( $filename_exclude ) && 'file' === $type ) {
			foreach ( $filename_exclude as $filename ) {
				if ( preg_match( '/' . $filename . '/', pathinfo( $path, PATHINFO_BASENAME ) ) ) {
					return false;
				}
			}
		}

		// Now abs path.
		$path_exclude = isset( $exclude['path'] ) ? $exclude['path'] : [];
		if ( is_array( $path_exclude ) && count( $path_exclude ) && 'file' === $type ) {
			foreach ( $path_exclude as $p ) {
				if ( strcmp( $p, $path ) === 0 ) {
					return false;
				}
			}
		}

		return true;
	}
}