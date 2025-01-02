<?php
// defaults.
$vars = array(
	'error_message'        => '',
	'sandbox_id'           => '',
	'sandbox_id_error'     => '',
	'sandbox_secret'       => '',
	'sandbox_secret_error' => '',
	'live_id'              => '',
	'live_id_error'        => '',
	'live_secret'          => '',
	'live_secret_error'    => '',

);
/** @var array $template_vars */
foreach ( $template_vars as $key => $val ) {
	$vars[ $key ] = $val;
}
?>

<span class="sui-description"><?php /* translators: ... */ printf( esc_html__( 'Enter your PayPal REST API keys to connect your account. You can create a REST API app %1$shere%2$s to grab the credentials.' ), '<a href="https://developer.paypal.com/developer/applications/" target="_blank">', '</a>' ); ?></span>

<?php if ( ! empty( $vars['error_message'] ) ) : ?>

	<div
		role="alert"
		class="sui-notice sui-notice-red sui-active"
		style="display: block; text-align: left;"
		aria-live="assertive"
	>

		<div class="sui-notice-content">

			<div class="sui-notice-message">

				<span class="sui-notice-icon sui-icon-info" aria-hidden="true"></span>

				<p><?php echo esc_html( $vars['error_message'] ); ?></p>

			</div>

		</div>

	</div>

<?php endif; ?>

<form class="sui-form-field">

	<div class="sui-form-field <?php echo esc_attr( ! empty( $vars['sandbox_id_error'] ) ? 'sui-form-field-error' : '' ); ?>">

		<label class="sui-label"><?php esc_html_e( 'Sandbox Client ID', 'forminator' ); ?></label>

		<input
			class="sui-form-control"
			name="sandbox_id" placeholder="<?php echo esc_attr( __( 'Enter your sandbox client id', 'forminator' ) ); ?>"
			value="<?php echo esc_attr( $vars['sandbox_id'] ); ?>"
		/>
		<?php if ( ! empty( $vars['sandbox_id_error'] ) ) : ?>
			<span class="sui-error-message"><?php echo esc_html( $vars['sandbox_id_error'] ); ?></span>
		<?php endif; ?>

	</div>

	<div class="sui-form-field <?php echo esc_attr( ! empty( $vars['sandbox_secret_error'] ) ? 'sui-form-field-error' : '' ); ?>">

		<label class="sui-label"><?php esc_html_e( 'Sandbox Secret', 'forminator' ); ?></label>

		<input
			class="sui-form-control"
			name="sandbox_secret" placeholder="<?php echo esc_attr( __( 'Enter your sandbox secret', 'forminator' ) ); ?>"
			value="<?php echo esc_attr( $vars['sandbox_secret'] ); ?>"
		/>

		<?php if ( ! empty( $vars['sandbox_secret_error'] ) ) : ?>
			<span class="sui-error-message"><?php echo esc_html( $vars['sandbox_secret_error'] ); ?></span>
		<?php endif; ?>

	</div>

	<div class="sui-form-field <?php echo esc_attr( ! empty( $vars['live_id_error'] ) ? 'sui-form-field-error' : '' ); ?>">

		<label class="sui-label"><?php esc_html_e( 'Live Client ID', 'forminator' ); ?></label>

		<input
			class="sui-form-control"
			name="live_id" placeholder="<?php echo esc_attr( __( 'Enter your live client id', 'forminator' ) ); ?>"
			value="<?php echo esc_attr( $vars['live_id'] ); ?>"
		/>

		<?php if ( ! empty( $vars['live_id_error'] ) ) : ?>
			<span class="sui-error-message"><?php echo esc_html( $vars['live_id_error'] ); ?></span>
		<?php endif; ?>

	</div>

	<div class="sui-form-field <?php echo esc_attr( ! empty( $vars['live_secret_error'] ) ? 'sui-form-field-error' : '' ); ?>">

		<label class="sui-label"><?php esc_html_e( 'Live Secret Key', 'forminator' ); ?></label>

		<input
			class="sui-form-control"
			name="live_secret" placeholder="<?php echo esc_attr( __( 'Enter your live secret id', 'forminator' ) ); ?>"
			value="<?php echo esc_attr( $vars['live_secret'] ); ?>"
		/>

		<?php if ( ! empty( $vars['live_secret_error'] ) ) : ?>
			<span class="sui-error-message"><?php echo esc_html( $vars['live_secret_error'] ); ?></span>
		<?php endif; ?>

	</div>

</form>