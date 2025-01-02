<?php get_header() ?>





















<div class="articleHead">
    <svg class="svg1" xmlns="http://www.w3.org/2000/svg" width="767" height="498" viewBox="0 0 767 498" fill="none">
        <path d="M-387.618 395.1C-388.309 395.893 -388.268 397.085 -387.525 397.829L-334.205 451.149C-333.386 451.967 -332.045 451.922 -331.284 451.049L433.28 -425.438C433.971 -426.23 433.931 -427.423 433.187 -428.167L379.868 -481.486C379.049 -482.305 377.708 -482.259 376.947 -481.387L-387.618 395.1Z" fill="url(#paint0_linear_642_25887)" fill-opacity="0.03" />
        <path d="M446.425 -414.929C445.606 -415.748 444.265 -415.702 443.503 -414.83L-321.061 461.657C-321.752 462.45 -321.711 463.642 -320.968 464.386L-267.648 517.705C-266.829 518.524 -265.488 518.479 -264.727 517.606L499.837 -358.881C500.528 -359.673 500.488 -360.866 499.744 -361.61L446.425 -414.929Z" fill="url(#paint1_linear_642_25887)" fill-opacity="0.03" />
        <path d="M512.982 -348.372C512.163 -349.191 510.822 -349.145 510.06 -348.273L-254.504 528.214C-255.195 529.007 -255.154 530.199 -254.411 530.943L-201.091 584.262C-200.272 585.081 -198.931 585.036 -198.17 584.163L566.394 -292.324C567.085 -293.116 567.045 -294.309 566.301 -295.053L512.982 -348.372Z" fill="url(#paint2_linear_642_25887)" fill-opacity="0.03" />
        <path d="M579.539 -281.815C578.72 -282.634 577.379 -282.588 576.617 -281.716L-187.947 594.771C-188.638 595.564 -188.597 596.756 -187.854 597.5L-134.534 650.819C-133.715 651.638 -132.374 651.593 -131.613 650.72L632.951 -225.767C633.642 -226.56 633.602 -227.752 632.858 -228.496L579.539 -281.815Z" fill="url(#paint3_linear_642_25887)" fill-opacity="0.03" />
        <path d="M646.096 -215.258C645.277 -216.077 643.936 -216.032 643.174 -215.159L-121.39 661.328C-122.081 662.121 -122.041 663.313 -121.297 664.057L-67.9775 717.376C-67.1585 718.195 -65.8174 718.15 -65.0561 717.277L699.508 -159.21C700.199 -160.002 700.159 -161.195 699.415 -161.939L646.096 -215.258Z" fill="url(#paint4_linear_642_25887)" fill-opacity="0.03" />
        <path d="M712.653 -148.701C711.834 -149.52 710.493 -149.475 709.731 -148.602L-54.8328 727.885C-55.5242 728.678 -55.4836 729.87 -54.7399 730.614L-1.42053 783.933C-0.601603 784.752 0.739491 784.707 1.5008 783.834L766.065 -92.653C766.756 -93.4457 766.716 -94.6382 765.972 -95.382L712.653 -148.701Z" fill="url(#paint5_linear_642_25887)" fill-opacity="0.03" />
        <defs>
            <linearGradient id="paint0_linear_642_25887" x1="-33.323" y1="-71.3231" x2="411.77" y2="373.77" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint1_linear_642_25887" x1="-33.323" y1="-71.3231" x2="411.77" y2="373.77" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint2_linear_642_25887" x1="-33.323" y1="-71.3231" x2="411.77" y2="373.77" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint3_linear_642_25887" x1="-33.323" y1="-71.3231" x2="411.77" y2="373.77" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint4_linear_642_25887" x1="-33.323" y1="-71.3231" x2="411.77" y2="373.77" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint5_linear_642_25887" x1="-33.323" y1="-71.3231" x2="411.77" y2="373.77" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
        </defs>
    </svg>
    <div class="articleHeadMain">
        <p class="articleHeadTitle">
            <?php the_title() ?>
        </p>
        <p class="articleHeadP">
            <?php
            $informations = get_post_meta(get_the_ID(), 'ts24_informations', true);
            if ($informations) {
                echo esc_html($informations);
            }
            ?>
        </p>
    </div>
    <svg class="svg2" xmlns="http://www.w3.org/2000/svg" width="828" height="498" viewBox="0 0 828 498" fill="none">
        <path d="M1154.4 102.786C1155.1 101.993 1155.06 100.801 1154.31 100.057L1100.99 46.7377C1100.17 45.9188 1098.83 45.9645 1098.07 46.8372L333.507 923.324C332.816 924.117 332.856 925.309 333.6 926.053L386.919 979.372C387.738 980.191 389.079 980.146 389.841 979.273L1154.4 102.786Z" fill="url(#paint0_linear_642_25888)" fill-opacity="0.03" />
        <path d="M320.362 912.815C321.181 913.634 322.522 913.589 323.284 912.716L1087.85 36.2291C1088.54 35.4365 1088.5 34.2438 1087.75 33.5001L1034.44 -19.8192C1033.62 -20.6382 1032.28 -20.5925 1031.51 -19.7198L266.95 856.767C266.259 857.56 266.299 858.752 267.043 859.496L320.362 912.815Z" fill="url(#paint1_linear_642_25888)" fill-opacity="0.03" />
        <path d="M253.805 846.258C254.624 847.077 255.965 847.032 256.727 846.159L1021.29 -30.3279C1021.98 -31.1205 1021.94 -32.3131 1021.2 -33.0568L967.878 -86.3762C967.06 -87.1951 965.718 -87.1494 964.957 -86.2767L200.393 790.21C199.702 791.003 199.742 792.195 200.486 792.939L253.805 846.258Z" fill="url(#paint2_linear_642_25888)" fill-opacity="0.03" />
        <path d="M187.248 779.702C188.067 780.52 189.408 780.475 190.17 779.602L954.734 -96.8848C955.425 -97.6774 955.385 -98.8701 954.641 -99.6138L901.321 -152.933C900.503 -153.752 899.161 -153.706 898.4 -152.834L133.836 723.653C133.145 724.446 133.185 725.638 133.929 726.382L187.248 779.702Z" fill="url(#paint3_linear_642_25888)" fill-opacity="0.03" />
        <path d="M120.692 713.145C121.51 713.964 122.852 713.918 123.613 713.045L888.177 -163.442C888.868 -164.234 888.828 -165.427 888.084 -166.171L834.765 -219.49C833.946 -220.309 832.604 -220.263 831.843 -219.391L67.2793 657.096C66.5879 657.889 66.6285 659.082 67.3722 659.825L120.692 713.145Z" fill="url(#paint4_linear_642_25888)" fill-opacity="0.03" />
        <path d="M54.1346 646.588C54.9535 647.407 56.2946 647.361 57.0559 646.488L821.62 -229.999C822.311 -230.791 822.271 -231.984 821.527 -232.728L768.208 -286.047C767.389 -286.866 766.048 -286.82 765.286 -285.948L0.722273 590.539C0.0309191 591.332 0.0715312 592.525 0.815236 593.268L54.1346 646.588Z" fill="url(#paint5_linear_642_25888)" fill-opacity="0.03" />
        <defs>
            <linearGradient id="paint0_linear_642_25888" x1="800.11" y1="569.209" x2="355.017" y2="124.116" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint1_linear_642_25888" x1="800.11" y1="569.209" x2="355.017" y2="124.116" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint2_linear_642_25888" x1="800.11" y1="569.209" x2="355.017" y2="124.116" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint3_linear_642_25888" x1="800.11" y1="569.209" x2="355.017" y2="124.116" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint4_linear_642_25888" x1="800.11" y1="569.209" x2="355.017" y2="124.116" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint5_linear_642_25888" x1="800.11" y1="569.209" x2="355.017" y2="124.116" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
        </defs>
    </svg>
</div>


<div class="aboutImg">
    <?php the_post_thumbnail('full', ['class' => 'blog-thumbnail', 'alt' => '', 'style' => '']); ?>
</div>

<div class="singleContainer">

<?php the_content() ?>


</div>




<?php get_template_part('parts/ctaSectionOrange'); ?>

<?php get_footer() ?>