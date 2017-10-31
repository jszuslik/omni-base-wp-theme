<?php

if ( function_exists('omni_require_file') ) {

	/**
	 * Load Classes
	 */
	omni_require_file( OMNI_CORE_PATH . 'OmniSetup.php');
	omni_require_file(OMNI_CORE_PATH . 'options/OmniOptions.php');
	omni_require_file( OMNI_CORE_PATH . 'bootstrap-navigation/WP_Bootstrap_Navwalker.php');
	omni_require_file( OMNI_CORE_PATH . 'customizer/default/OmniDefault.php');
	omni_require_file( OMNI_CORE_PATH . 'customizer/OmniCustomizer.php');
	omni_require_file( OMNI_CORE_PATH . 'OmniCore.php');
	omni_require_file( OMNI_CORE_PATH . 'widgets/OmniWidgetBase.php');
	omni_require_file( OMNI_CORE_PATH . 'widgets/OmniWidgetInit.php');
	omni_require_file( OMNI_CORE_PATH . 'widgets/OmniSocialWidget.php');
	omni_require_file( OMNI_CORE_PATH . 'common/OmniCommon.php');
	omni_require_file( OMNI_CORE_PATH . 'customizer/frontend/js/OmniInternalJS.php');
	omni_require_file( OMNI_CORE_PATH . 'customizer/frontend/css/OmniInternalCSS.php');

	omni_require_file( OMNI_CORE_PATH . 'custom-post-types/homepage-section/OmniHomepageSectionPostType.php');
	omni_require_file( OMNI_CORE_PATH . 'custom-post-types/homepage-section/meta/Omni2ColumnWithHeaderMeta.php');
	omni_require_file( OMNI_CORE_PATH . 'custom-post-types/homepage-section/meta/OmniFullWidthImageSectionMeta.php');
	omni_require_file( OMNI_CORE_PATH . 'custom-post-types/homepage-section/meta/Omni2ColumnProductSectionMeta.php');
	omni_require_file( OMNI_CORE_PATH . 'custom-post-types/homepage-section/meta/OmniSingleImageBackgroundMeta.php');
	omni_require_file( OMNI_CORE_PATH . 'custom-post-types/homepage-section/meta/Omni2ColumnImageSideMeta.php');
	omni_require_file( OMNI_CORE_PATH . 'custom-post-types/homepage-section/meta/Omni2Col2RowHeaderMeta.php');
	omni_require_file( OMNI_CORE_PATH . 'custom-post-types/homepage-section/meta/OmniPressRoomMeta.php');
	omni_require_file( OMNI_CORE_PATH . 'opt-in-form/database/OmniOptInFormSetup.php');
	omni_require_file( OMNI_CORE_PATH . 'opt-in-form/OmniOptInFormEntries.php');
	omni_require_file( OMNI_CORE_PATH . 'opt-in-form/settings/OmniOptInFormSettings.php');

	// Custom hooks
	omni_require_file( OMNI_CORE_PATH . 'hook/OmniHeaderCustomHook.php');
	omni_require_file( OMNI_CORE_PATH . 'hook/OmniFooterHook.php');
	omni_require_file( OMNI_CORE_PATH . 'hook/OmniJumbotronHook.php');
	omni_require_file( OMNI_CORE_PATH . 'hook/OmniHomepageSectionHook.php');
	omni_require_file( OMNI_CORE_PATH . 'hook/OmniStructureHook.php');
}