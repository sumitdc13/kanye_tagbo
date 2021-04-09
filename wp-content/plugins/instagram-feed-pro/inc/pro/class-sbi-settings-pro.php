<?php
/**
 * Class SB_Instagram_Settings_Pro
 *
 * @since 5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class SB_Instagram_Settings_Pro extends SB_Instagram_Settings{

	private $business_accounts;

	/**
	 * SB_Instagram_Settings constructor.
	 *
	 * @param $atts
	 * @param $db
	 */
	public function __construct( $atts, $db ) {
		$this->atts = $atts;
		$this->db   = $db;

		$this->connected_accounts = isset( $db['connected_accounts'] ) ? $db['connected_accounts'] : array();

		//Create the includes string to set as shortcode default
		$hover_include_string = '';
		if( isset($db[ 'sbi_hover_inc_username' ]) ){
			($db[ 'sbi_hover_inc_username' ] && $db[ 'sbi_hover_inc_username' ] !== '') ? $hover_include_string .= 'username,' : $hover_include_string .= '';
		}
		//If the username option doesn't exist in the database yet (eg: on plugin update) then set it to be displayed
		if ( !array_key_exists( 'sbi_hover_inc_username', $db ) ) $hover_include_string .= 'username,';

		if( isset($db[ 'sbi_hover_inc_icon' ]) ){
			($db[ 'sbi_hover_inc_icon' ] && $db[ 'sbi_hover_inc_icon' ] !== '') ? $hover_include_string .= 'icon,' : $hover_include_string .= '';
		}
		if ( !array_key_exists( 'sbi_hover_inc_icon', $db ) ) $hover_include_string .= 'icon,';

		if( isset($db[ 'sbi_hover_inc_date' ]) ){
			($db[ 'sbi_hover_inc_date' ] && $db[ 'sbi_hover_inc_date' ] !== '') ? $hover_include_string .= 'date,' : $hover_include_string .= '';
		}
		if ( !array_key_exists( 'sbi_hover_inc_date', $db ) ) $hover_include_string .= 'date,';

		if( isset($db[ 'sbi_hover_inc_instagram' ]) ){
			($db[ 'sbi_hover_inc_instagram' ] && $db[ 'sbi_hover_inc_instagram' ] !== '') ? $hover_include_string .= 'instagram,' : $hover_include_string .= '';
		}
		if ( !array_key_exists( 'sbi_hover_inc_instagram', $db ) ) $hover_include_string .= 'instagram,';

		if( isset($db[ 'sbi_hover_inc_location' ]) ){
			($db[ 'sbi_hover_inc_location' ] && $db[ 'sbi_hover_inc_location' ] !== '') ? $hover_include_string .= 'location,' : $hover_include_string .= '';
		}
		if( isset($db[ 'sbi_hover_inc_caption' ]) ){
			($db[ 'sbi_hover_inc_caption' ] && $db[ 'sbi_hover_inc_caption' ] !== '') ? $hover_include_string .= 'caption,' : $hover_include_string .= '';
		}
		if( isset($db[ 'sbi_hover_inc_likes' ]) ){
			($db[ 'sbi_hover_inc_likes' ] && $db[ 'sbi_hover_inc_likes' ] !== '') ? $hover_include_string .= 'likes,' : $hover_include_string .= '';
		}
		if ( isset( $db[ 'sb_instagram_incex_one_all' ] ) ) {
			if ( $db[ 'sb_instagram_incex_one_all' ]  == 'one' ) {
				$db[ 'sb_instagram_include_words' ] = '';
				$db[ 'sb_instagram_exclude_words' ] = '';
			}
		}
		
		$this->settings = shortcode_atts(
			array(
				//Feed general
				'type' => isset($db[ 'sb_instagram_type' ]) ? $db[ 'sb_instagram_type' ] : 'user',
				'order' => isset($db[ 'sb_instagram_order' ]) ? $db[ 'sb_instagram_order' ] : '',
				'id' => isset($db[ 'sb_instagram_user_id' ]) ? $db[ 'sb_instagram_user_id' ] : '',
				'hashtag' => isset($db[ 'sb_instagram_hashtag' ]) ? $db[ 'sb_instagram_hashtag' ] : '',
				'location' => isset($db[ 'sb_instagram_location' ]) ? $db[ 'sb_instagram_location' ] : '',
				'coordinates' => isset($db[ 'sb_instagram_coordinates' ]) ? $db[ 'sb_instagram_coordinates' ] : '',
				'single' => '',
				'width' => isset($db[ 'sb_instagram_width' ]) ? $db[ 'sb_instagram_width' ] : '',
				'widthunit' => isset($db[ 'sb_instagram_width_unit' ]) ? $db[ 'sb_instagram_width_unit' ] : '',
				'widthresp' => isset($db[ 'sb_instagram_feed_width_resp' ]) ? $db[ 'sb_instagram_feed_width_resp' ] : '',
				'height' => isset($db[ 'sb_instagram_height' ]) ? $db[ 'sb_instagram_height' ] : '',
				'heightunit' => isset($db[ 'sb_instagram_height_unit' ]) ? $db[ 'sb_instagram_height_unit' ] : '',
				'sortby' => isset($db[ 'sb_instagram_sort' ]) ? $db[ 'sb_instagram_sort' ] : '',
				'disablelightbox' => isset($db[ 'sb_instagram_disable_lightbox' ]) ? $db[ 'sb_instagram_disable_lightbox' ] : '',
				'captionlinks' => isset($db[ 'sb_instagram_captionlinks' ]) ? $db[ 'sb_instagram_captionlinks' ] : '',
				'num' => isset($db[ 'sb_instagram_num' ]) ? $db[ 'sb_instagram_num' ] : '',
				'nummobile' => isset($db[ 'sb_instagram_nummobile' ]) ? $db[ 'sb_instagram_nummobile' ] : '',
				'cols' => isset($db[ 'sb_instagram_cols' ]) ? $db[ 'sb_instagram_cols' ] : '',
				'colsmobile' => isset($db[ 'sb_instagram_colsmobile' ]) ? $db[ 'sb_instagram_colsmobile' ] : '',
				'disablemobile' => isset($db[ 'sb_instagram_disable_mobile' ]) ? $db[ 'sb_instagram_disable_mobile' ] : '',
				'imagepadding' => isset($db[ 'sb_instagram_image_padding' ]) ? $db[ 'sb_instagram_image_padding' ] : '',
				'imagepaddingunit' => isset($db[ 'sb_instagram_image_padding_unit' ]) ? $db[ 'sb_instagram_image_padding_unit' ] : '',
				'layout' => isset($db[ 'sb_instagram_layout_type' ]) ? $db[ 'sb_instagram_layout_type' ] : 'grid',

				//Lightbox comments
				'lightboxcomments' => isset($db[ 'sb_instagram_lightbox_comments' ]) ? $db[ 'sb_instagram_lightbox_comments' ] : '',
				'numcomments' => isset($db[ 'sb_instagram_num_comments' ]) ? $db[ 'sb_instagram_num_comments' ] : '',

				//Photo hover styles
				'hovereffect' => isset($db[ 'sb_instagram_hover_effect' ]) ? $db[ 'sb_instagram_hover_effect' ] : '',
				'hovercolor' => isset($db[ 'sb_hover_background' ]) ? $db[ 'sb_hover_background' ] : '',
				'hovertextcolor' => isset($db[ 'sb_hover_text' ]) ? $db[ 'sb_hover_text' ] : '',
				'hoverdisplay' => $hover_include_string,

				//Item misc
				'background' => isset($db[ 'sb_instagram_background' ]) ? $db[ 'sb_instagram_background' ] : '',
				'imageres' => isset($db[ 'sb_instagram_image_res' ]) ? $db[ 'sb_instagram_image_res' ] : '',
				'media' => isset($db[ 'sb_instagram_media_type' ]) ? $db[ 'sb_instagram_media_type' ] : '',
				'showcaption' => isset($db[ 'sb_instagram_show_caption' ]) ? $db[ 'sb_instagram_show_caption' ] : '',
				'captionlength' => isset($db[ 'sb_instagram_caption_length' ]) ? $db[ 'sb_instagram_caption_length' ] : '',
				'captioncolor' => isset($db[ 'sb_instagram_caption_color' ]) ? $db[ 'sb_instagram_caption_color' ] : '',
				'captionsize' => isset($db[ 'sb_instagram_caption_size' ]) ? $db[ 'sb_instagram_caption_size' ] : '',
				'showlikes' => isset($db[ 'sb_instagram_show_meta' ]) ? $db[ 'sb_instagram_show_meta' ] : '',
				'likescolor' => isset($db[ 'sb_instagram_meta_color' ]) ? $db[ 'sb_instagram_meta_color' ] : '',
				'likessize' => isset($db[ 'sb_instagram_meta_size' ]) ? $db[ 'sb_instagram_meta_size' ] : '',
				'hidephotos' => isset($db[ 'sb_instagram_hide_photos' ]) ? $db[ 'sb_instagram_hide_photos' ] : '',

				//Footer
				'showbutton' => isset($db[ 'sb_instagram_show_btn' ]) ? $db[ 'sb_instagram_show_btn' ] : '',
				'buttoncolor' => isset($db[ 'sb_instagram_btn_background' ]) ? $db[ 'sb_instagram_btn_background' ] : '',
				'buttontextcolor' => isset($db[ 'sb_instagram_btn_text_color' ]) ? $db[ 'sb_instagram_btn_text_color' ] : '',
				'buttontext' => isset($db[ 'sb_instagram_btn_text' ]) ? stripslashes( esc_attr( $db[ 'sb_instagram_btn_text' ] ) ) : '',
				'showfollow' => isset($db[ 'sb_instagram_show_follow_btn' ]) ? $db[ 'sb_instagram_show_follow_btn' ] : '',
				'followcolor' => isset($db[ 'sb_instagram_folow_btn_background' ]) ? $db[ 'sb_instagram_folow_btn_background' ] : '',
				'followtextcolor' => isset($db[ 'sb_instagram_follow_btn_text_color' ]) ? $db[ 'sb_instagram_follow_btn_text_color' ] : '',
				'followtext' => isset($db[ 'sb_instagram_follow_btn_text' ]) ? stripslashes( esc_attr( $db[ 'sb_instagram_follow_btn_text' ] ) ) : '',

				//Header
				'showheader' => isset($db[ 'sb_instagram_show_header' ]) ? $db[ 'sb_instagram_show_header' ] : '',
				'headercolor' => isset($db[ 'sb_instagram_header_color' ]) ? $db[ 'sb_instagram_header_color' ] : '',
				'headerstyle' => isset($db[ 'sb_instagram_header_style' ]) ? $db[ 'sb_instagram_header_style' ] : '',
				'showfollowers' => isset($db[ 'sb_instagram_show_followers' ]) ? $db[ 'sb_instagram_show_followers' ] : '',
				'showbio' => isset($db[ 'sb_instagram_show_bio' ]) ? $db[ 'sb_instagram_show_bio' ] : '',
				'headerprimarycolor' => isset($db[ 'sb_instagram_header_primary_color' ]) ? $db[ 'sb_instagram_header_primary_color' ] : '',
				'headersecondarycolor' => isset($db[ 'sb_instagram_header_secondary_color' ]) ? $db[ 'sb_instagram_header_secondary_color' ] : '',
				'headersize' => isset($db[ 'sb_instagram_header_size' ]) ? $db[ 'sb_instagram_header_size' ] : '',
				'stories' => isset($db[ 'sb_instagram_stories' ]) ? $db[ 'sb_instagram_stories' ] : '',
				'storiestime' => isset($db[ 'sb_instagram_stories_time' ]) ? $db[ 'sb_instagram_stories_time' ] : '',
				'headeroutside' => isset($db[ 'sb_instagram_outside_scrollable' ]) ? $db[ 'sb_instagram_outside_scrollable' ] : '',

				'class' => '',
				'ajaxtheme' => isset($db[ 'sb_instagram_ajax_theme' ]) ? $db[ 'sb_instagram_ajax_theme' ] : '',
				'cachetime' => isset($db[ 'sb_instagram_cache_time' ]) ? $db[ 'sb_instagram_cache_time' ] : '',
				'blockusers' => isset($db[ 'sb_instagram_block_users' ]) ? $db[ 'sb_instagram_block_users' ] : '',
				'showusers' => isset($db[ 'sb_instagram_show_users' ]) ? $db[ 'sb_instagram_show_users' ] : '',
				'excludewords' => isset($db[ 'sb_instagram_exclude_words' ]) ? $db[ 'sb_instagram_exclude_words' ] : '',
				'includewords' => isset($db[ 'sb_instagram_include_words' ]) ? $db[ 'sb_instagram_include_words' ] : '',
				'maxrequests' => isset($db[ 'sb_instagram_requests_max' ]) ? $db[ 'sb_instagram_requests_max' ] : '',

				//Carousel
				'carousel' => isset($db[ 'sb_instagram_carousel' ]) ? $db[ 'sb_instagram_carousel' ] : '',
				'carouselrows' => isset($db[ 'sb_instagram_carousel_rows' ]) ? $db[ 'sb_instagram_carousel_rows' ] : '',
				'carouselloop' => isset($db[ 'sb_instagram_carousel_loop' ]) ? $db[ 'sb_instagram_carousel_loop' ] : '',
				'carouselarrows' => isset($db[ 'sb_instagram_carousel_arrows' ]) ? $db[ 'sb_instagram_carousel_arrows' ] : '',
				'carouselpag' => isset($db[ 'sb_instagram_carousel_pag' ]) ? $db[ 'sb_instagram_carousel_pag' ] : '',
				'carouselautoplay' => isset($db[ 'sb_instagram_carousel_autoplay' ]) ? $db[ 'sb_instagram_carousel_autoplay' ] : '',
				'carouseltime' => isset($db[ 'sb_instagram_carousel_interval' ]) ? $db[ 'sb_instagram_carousel_interval' ] : '',

				//Highlight
				'highlighttype' => isset($db[ 'sb_instagram_highlight_type' ]) ? $db[ 'sb_instagram_highlight_type' ] : '',
				'highlightoffset' => isset($db[ 'sb_instagram_highlight_offset' ]) ? $db[ 'sb_instagram_highlight_offset' ] : '',
				'highlightpattern' => isset($db[ 'sb_instagram_highlight_factor' ]) ? $db[ 'sb_instagram_highlight_factor' ] : '',
				'highlighthashtag' => isset($db[ 'sb_instagram_highlight_hashtag' ]) ? $db[ 'sb_instagram_highlight_hashtag' ] : '',
				'highlightids' => isset($db[ 'sb_instagram_highlight_ids' ]) ? $db[ 'sb_instagram_highlight_ids' ] : '',

				//WhiteList
				'whitelist' => '',

				//Load More on Scroll
				'autoscroll' => isset($db[ 'sb_instagram_autoscroll' ]) ? $db[ 'sb_instagram_autoscroll' ] : '',
				'autoscrolldistance' => isset($db[ 'sb_instagram_autoscrolldistance' ]) ? $db[ 'sb_instagram_autoscrolldistance' ] : '',

				//Moderation Mode
				'moderationmode' => isset($db[ 'sb_instagram_moderation_mode' ]) ? $db[ 'sb_instagram_moderation_mode' ] === 'visual' : '',

				//Permanent
				'permanent' => isset($db[ 'sb_instagram_permanent' ]) ? $db[ 'sb_instagram_permanent' ] : false,
				'accesstoken' => '',
				'user' => isset($db[ 'sb_instagram_user_id' ]) ? $db[ 'sb_instagram_user_id' ] : false,

				//Misc
				'feedid' => isset($db[ 'sb_instagram_feed_id' ]) ? $db[ 'sb_instagram_feed_id' ] : false,

				'resizeprocess'    => isset( $db['sb_instagram_resizeprocess'] ) ? $db['sb_instagram_resizeprocess'] : 'background',
				'mediavine'    => isset( $db['sb_instagram_media_vine'] ) ? $db['sb_instagram_media_vine'] : '',

			), $atts );

		$this->settings['num'] = max( (int)$this->settings['num'], 1);
		$this->settings['minnum'] = max( $this->settings['num'], max( (int)$this->settings['nummobile'], 1 ) );
		$this->settings['disable_resize'] = isset( $db['sb_instagram_disable_resize'] ) && ($db['sb_instagram_disable_resize'] === 'on');
		$this->settings['favor_local'] = isset( $db['sb_instagram_favor_local'] ) && ($db['sb_instagram_favor_local'] === 'on');
		$this->settings['backup_cache_enabled'] = ! isset( $db['sb_instagram_backup'] ) || ($db['sb_instagram_backup'] === 'on');
		$this->settings['font_method'] = isset( $db['sbi_font_method'] ) ? $db['sbi_font_method'] : 'svg';

		$this->settings['disable_js_image_loading'] = isset( $db['disable_js_image_loading'] ) && ($db['disable_js_image_loading'] === 'on');

		switch ( $db['sbi_cache_cron_interval'] ) {
			case '30mins' :
				$this->settings['sbi_cache_cron_interval'] = 60*30;
				break;
			case '1hour' :
				$this->settings['sbi_cache_cron_interval'] = 60*60;
				break;
			default :
				$this->settings['sbi_cache_cron_interval'] = 60*60*12;
		}
		$this->settings['stories'] = (($this->settings['stories'] === '' && ! isset( $db['sb_instagram_stories'])) || $this->settings['stories'] === true || $this->settings['stories'] === 'on' || $this->settings['stories'] === 'true') && $this->settings['stories'] !== 'false';

		$this->settings['addModerationModeLink'] = ($this->settings['moderationmode'] === true || $this->settings['moderationmode'] === 'on' || $this->settings['moderationmode'] === 'true') && current_user_can('edit_posts' );

		$moderation_mode = isset ( $atts['doingModerationMode'] );
		if ( $moderation_mode ) {
			$this->settings['cols'] = 5;
			$this->settings['colsmobile'] = 3;

			$this->settings['num'] = 50;
			$this->settings['lightboxcomments'] = false;
			$this->settings['media'] = 'all';
			$this->settings['showlikes'] = false;
			$this->settings['showcaption'] = false;
			$this->settings['showheader'] = true;
			$this->settings['showbutton'] = true;
			$this->settings['showfollow'] = false;
			$this->settings['disablelightbox'] = true;
			$this->settings['sortby'] = 'none';
			$this->settings['doingModerationMode'] = true;
		}

		$this->settings['caching_type'] = $db['sbi_caching_type'];

		$feed_is_permanent = isset( $atts['permanent'] ) ? ($atts['permanent'] === 'true') : false;
		$white_list_is_permanent = false;
		if ( ! empty( $this->settings['whitelist'] ) ) {
			$permanent_white_lists = get_option( 'sb_permanent_white_lists', array() );
			if ( in_array( $this->settings['whitelist'], $permanent_white_lists, true ) ) {
				$white_list_is_permanent = true;
			}

			$this->settings['whitelist_ids'] = get_option( 'sb_instagram_white_lists_'.$this->settings['whitelist'], array() );
			$this->settings['whitelist_num'] = count( $this->settings['whitelist_ids'] );
		}

		if ( $feed_is_permanent || $white_list_is_permanent ) {
			$this->settings['backup_cache_enabled'] = true;
			$this->settings['alwaysUseBackup'] = true;
			$this->settings['caching_type'] = 'permanent';
		} else {
			global $sb_instagram_posts_manager;
			if ( $sb_instagram_posts_manager->are_current_api_request_delays() ) {
				$this->settings['alwaysUseBackup'] = true;
				$this->settings['caching_type'] = 'permanent';
			}
		}

		$this->settings['headeroutside'] = ($this->settings['headeroutside'] === true || $this->settings['headeroutside'] === 'on' || $this->settings['headeroutside'] === 'true');
		if ( $this->settings['showheader'] === 'false' ) {
			$this->settings['showheader'] = false;
		}

		if ( empty( $atts['layout'] ) && isset( $atts['carousel'] ) && $atts['carousel'] === 'true' ) {
			$this->settings['layout'] = 'carousel';
		}

		$this->settings['ajax_post_load'] = isset( $db['sb_ajax_initial'] ) && ($db['sb_ajax_initial'] === 'on');
	}

	/**
	 * Sets the feed ID used to identify which posts to retrieve from the
	 * database among other important features. Uses a combination of the
	 * feed type,vfeed display settings, moderation settings, number
	 * settings, and post order. Can be set manually if two similar feeds
	 * share the same name and are causing conflicts.
	 *
	 * Pro - More factors used to create name (see above)
	 *
	 * @param string $transient_name
	 *
	 * @since 5.0
	 */
	public function set_transient_name( $transient_name = '' ) {

		if ( ! empty( $transient_name ) ) {
			$this->transient_name = $transient_name;
		} elseif ( ! empty( $this->settings['feedid'] ) ) {
			$this->transient_name = 'sbi_' . $this->settings['feedid'];
		} else {
			$feed_type_and_terms = $this->feed_type_and_terms;

			$sb_instagram_include_words = $this->settings['includewords'];
			$sb_instagram_exclude_words = $this->settings['excludewords'];
			$sbi_cache_string_include = '';
			$sbi_cache_string_exclude = '';

			//Convert include words array into a string consisting of 3 chars each
			if ( ! empty( $sb_instagram_include_words ) ) {
				$sb_instagram_include_words_arr = explode(',', $sb_instagram_include_words);

				foreach( $sb_instagram_include_words_arr as $sbi_word ){
					$sbi_include_word = str_replace( str_split(' #'), '', $sbi_word );
					$sbi_cache_string_include .= substr( str_replace('%','', urlencode( $sbi_include_word ) ), 0, 3 );
				}

			}

			//Convert exclude words array into a string consisting of 3 chars each
			if ( ! empty( $sb_instagram_exclude_words ) ) {
				$sb_instagram_exclude_words_arr = explode( ',', $sb_instagram_exclude_words );

				foreach( $sb_instagram_exclude_words_arr as $sbi_word ){
					$sbi_exclude_word = str_replace( str_split( ' #' ) , '', $sbi_word );
					$sbi_cache_string_exclude .= substr( str_replace( '%','', urlencode( $sbi_exclude_word ) ), 0, 3 );
				}

			}

			//Figure out how long the first part of the caching string should be
			$sbi_cache_string_include_length = strlen( $sbi_cache_string_include );
			$sbi_cache_string_exclude_length = strlen( $sbi_cache_string_exclude );
			$sbi_cache_string_length = 40 - min( $sbi_cache_string_include_length + $sbi_cache_string_exclude_length, 20 );

			isset( $this->settings[ 'whitelist' ] ) ? $sb_instagram_white_list = trim( $this->settings['whitelist'] ) : $sb_instagram_white_list = '';
			$sbi_transient_name = 'sbi_';
			$sbi_transient_name .= substr( $sb_instagram_white_list, 0, 3 );

			if ( $this->settings['media'] !== 'all' ) {
				$sbi_transient_name .= substr( $this->settings['media'], 0, 1 );
			}

			if ( isset( $feed_type_and_terms['users'] ) ) {
				foreach ( $feed_type_and_terms['users'] as $term_and_params ) {
					$user = $term_and_params['term'];
					$connected_account = $this->connected_accounts_in_feed[ $user ];
					if ( isset( $connected_account['type'] ) && $connected_account['type'] === 'business' ) {
						$sbi_transient_name .= $connected_account['username'];
					} else {
						$sbi_transient_name .= $user;
					}
				}
			}

			if ( isset( $feed_type_and_terms['hashtags_top'] ) || isset( $feed_type_and_terms['hashtags_recent'] ) ) {
				if ( isset( $feed_type_and_terms['hashtags_top'] ) ) {
					$terms_params = $feed_type_and_terms['hashtags_top'];
					$sbi_transient_name .= '+';
				} else {
					$terms_params = $feed_type_and_terms['hashtags_recent'];
				}

				foreach ( $terms_params as $term_and_params ) {
					$hashtag = $term_and_params['hashtag_name'];
					$full_tag = str_replace('%','',urlencode( $hashtag ));
					$max_length = strlen( $full_tag ) < 20 ? strlen( $full_tag ) : 20;
					$sbi_transient_name .= strtoupper( substr( $full_tag, 0, $max_length ) );
				}
			}

			$num = $this->settings['num'];

			$num_length = strlen( $num ) + 1;

			// add filter prefix and suffixes substr( $sb_instagram_white_list, 0, 3 )

			//Add both parts of the caching string together and make sure it doesn't exceed 45
			$sbi_transient_name = substr( $sbi_transient_name, 0, $sbi_cache_string_length - $num_length ) . $sbi_cache_string_include . $sbi_cache_string_exclude;

			if ( ! isset( $this->settings['doingModerationMode'] ) ) {
				$sbi_transient_name .= '#' . $num;
			}

			$this->transient_name = $sbi_transient_name;
		}

	}

	/**
	 * Based on the settings related to retrieving post data from the API,
	 * this setting is used to make sure all endpoints needed for the feed are
	 * connected and stored for easily looping through when adding posts
	 *
	 * Pro - More feed types supported (hashtag_recent, hashtag_top)
	 *
	 * @since 5.0
	 */
	public function set_feed_type_and_terms() {
		global $sb_instagram_posts_manager;

		$connected_accounts_in_feed = array();

		if ( ! empty( $this->atts['accesstoken'] ) && strpos( $this->atts['accesstoken'], '.' ) !== false ) {
			$feed_type_and_terms = array(
				'users' => array()
			);

			$access_tokens = explode( ',', str_replace( ' ', '', $this->atts['accesstoken'] ) );

			foreach ( $access_tokens as $access_token ) {
				$split_token = explode( '.', $access_token );
				$connected_accounts_in_feed[ $split_token[0] ] = array(
					'access_token' => $access_token,
					'user_id' => $split_token[0],
					'username' => $split_token[0],
					'profile_picture' => ''
				);
				$feed_type_and_terms['users'][] = array(
					'term' => $split_token[0],
					'params' => array()
				);
			}

		} elseif ( $this->settings['type'] === 'user' ) {
			$feed_type_and_terms = array(
				'users' => array()
			);
			$usernames_included = array();

			if ( ! empty( $this->settings['user'] ) ) {
				$user_array = is_array( $this->settings['user'] ) ? $this->settings['user'] : explode( ',', str_replace( ' ', '',  $this->settings['user'] ) );
				foreach ( $user_array as $user ) {
					$user_found = false;
					if ( isset( $this->connected_accounts[ $user ] ) ) {
						if ( ! in_array( $this->connected_accounts[ $user ]['username'], $usernames_included, true ) ) {
							$feed_type_and_terms['users'][] = array(
								'term' => $this->connected_accounts[ $user ]['user_id'],
								'params' => array()
							);
							$connected_accounts_in_feed[ $this->connected_accounts[ $user ]['user_id'] ] = $this->connected_accounts[ $user ];
							$usernames_included[] = $this->connected_accounts[ $user ]['username'];
						}
					} else {

						foreach ( $this->connected_accounts as $connected_account ) {
							if ( strtolower( $user ) === strtolower( $connected_account['username'] ) ) {
								if ( ! in_array( $connected_account['username'], $usernames_included, true ) ) {
									if ( isset( $connected_account['type'] ) && $connected_account['type'] === 'business' ) {
										$feed_type_and_terms['users'][]      = array(
											'term' => $user,
											'params' => array()
										);
										$connected_accounts_in_feed[ $user ] = $connected_account;
									} else {
										$feed_type_and_terms['users'][]                              = array(
											'term' => $connected_account['user_id'],
											'params' => array()
										);
										$connected_accounts_in_feed[ $connected_account['user_id'] ] = $connected_account;
									}
									$usernames_included[] = $connected_account['username'];
									$user_found = true;
								}
							}
						}

						if ( ! $user_found ) {
							$error = '<p><b>' . sprintf( __( 'Error: There is no connected account for the user %s.', 'instagram-feed' ), $user ) . ' ' . __( 'Feed will not update.', 'instagram-feed' ) . '</b>';

							$sb_instagram_posts_manager->add_frontend_error( 'no_connection_' . $user, $error );
						}

					}

				}

			} elseif ( ! empty( $this->settings['id'] ) ) {
				$user_id_array = is_array( $this->settings['id'] ) ? $this->settings['id'] : explode( ',', str_replace( ' ', '',  $this->settings['id'] ) );

				foreach ( $user_id_array as $user ) {
					$user_found = false;

					if ( isset( $this->connected_accounts[ $user ] ) ) {
						if ( ! in_array( $this->connected_accounts[ $user ]['username'], $usernames_included, true ) ) {
							$feed_type_and_terms['users'][]                                              = array(
								'term' => $this->connected_accounts[ $user ]['user_id'],
								'params' => array()
							);
							$connected_accounts_in_feed[ $this->connected_accounts[ $user ]['user_id'] ] = $this->connected_accounts[ $user ];
							$usernames_included[]                                                        = $this->connected_accounts[ $user ]['username'];
						}

					} else {

						foreach ( $this->connected_accounts as $connected_account ) {
							if ( strtolower( $user ) === strtolower( $connected_account['username'] ) ) {
								if ( ! in_array( $this->connected_accounts[ $user ]['username'], $usernames_included, true ) ) {
									if ( isset( $connected_account['type'] ) && $connected_account['type'] === 'business' ) {
										$feed_type_and_terms['users'][]      = array(
											'term' => $user,
											'params' => array()
										);
										$connected_accounts_in_feed[ $user ] = $connected_account;
									} else {
										$feed_type_and_terms['users'][]                              =  array(
											'term' => $connected_account['user_id'],
											'params' => array()
										);
										$connected_accounts_in_feed[ $connected_account['user_id'] ] = $connected_account;
									}
									$usernames_included[] = $this->connected_accounts[ $user ]['username'];
									$user_found           = true;
								}
							}
						}

						if ( ! $user_found ) {
							$error = '<p><b>' . sprintf( __( 'Error: There is no connected account for the user %s', 'instagram-feed' ), $user ) . ' ' . __( 'Feed will not update.', 'instagram-feed' ) . '</b>';

							$sb_instagram_posts_manager->add_frontend_error( 'no_connection_' . $user, $error );
						}

					}

				}

			}

			if ( empty( $feed_type_and_terms['users'] ) ) {
				$error = '<p><b>' . __( 'Error: No users set.', 'instagram-feed' ) . '</b> ' . __( 'Please visit the plugin\'s settings page to select a user account or add one to the shortcode - user="username".', 'instagram-feed' ) . '</p>';

				$sb_instagram_posts_manager->add_frontend_error( 'no_user_set', $error );
			}

		} elseif ( $this->settings['type'] === 'hashtag' ) {
			$hashtag_order_suffix = $this->settings['order'] === 'recent' ? 'recent' : 'top';
			$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ] = array();

			$hashtags = is_array( $this->settings['hashtag'] ) ? $this->settings['hashtag'] : explode( ',', str_replace( array( ' ', '#' ), '', $this->settings['hashtag'] ) );
			if ( count( $hashtags ) > 1 ) {
				$this->settings['sortby'] = 'alternate';
			}
			$saved_hashtag_ids = SB_Instagram_Settings_Pro::get_hashtag_ids();

			foreach ( $this->connected_accounts as $connected_account ) {

				if ( isset( $connected_account['type'] ) && $connected_account['type'] === 'business' ) {
					$this->business_accounts[] = $connected_account;
				}
			}

			if ( ! empty( $this->business_accounts ) ) {

				$new_hashtag_ids = array();
				$connected_business_account = $this->business_accounts[0];
				$valid_hashtag_found = false;
				foreach ( $hashtags as $hashtag ) {
					if ( ! empty( $hashtag ) ) {
						$hashtag_id = false;

						if ( isset( $saved_hashtag_ids[ $hashtag ] ) ) {
							$hashtag_id = $saved_hashtag_ids[ $hashtag ];
						}

						$i = 0;
						$error_that_isnt_18 = false;
						$new_id_set = false;
						$account_found = false;

						while ( isset( $this->business_accounts[ $i ] ) && ! $new_id_set && ! $error_that_isnt_18 ) {

							if ( ! isset( $this->business_accounts[ $i ]['hashtag_limit_reached'] ) || $this->business_accounts[ $i ]['hashtag_limit_reached'] < time() - (7*24*60*60) ) {
								if ( isset( $this->business_accounts[ $i ]['hashtag_limit_reached'] ) ) {
									SB_Instagram_Settings_Pro::clear_hashtag_limit_reached( $this->business_accounts[ $i ] );
								}

								if ( $hashtag_id === false ) {
									$maybe_hashtag_id = SB_Instagram_Settings_Pro::get_remote_hashtag_id_from_hashtag_name( $hashtag, $this->business_accounts[ $i ] );

									if ( $maybe_hashtag_id === 'error_18' ) {
									} elseif ( $maybe_hashtag_id !== 'error_18' && $maybe_hashtag_id !== false ) {
										$account_found = true;
										$hashtag_id = $maybe_hashtag_id;
										$new_hashtag_ids[ $hashtag ] = $hashtag_id;
										$new_id_set = true;
										$connected_business_account = $this->business_accounts[ $i ];
									} else {
										if ( $maybe_hashtag_id === 'error_18' ) {
											$error_that_isnt_18 = false;
										} else {
											$error_that_isnt_18 = true;
										}
									}
								} else {
									$connected_business_account = $this->business_accounts[ $i ];
									$account_found = true;
								}



							}

							$i++;
						}

						$connected_business_account = $this->business_accounts[ 0 ];

						if ( ! $account_found ) {
							$date_format = get_option( 'date_format' );
							$time_format = get_option( 'time_format' );
							if ( $date_format && $time_format ) {
								$date_time_format = $date_format . ' ' . $time_format;
							} else {
								$date_time_format = 'F j, Y g:i a';
							}
							$error = '<p><b>' . __( 'Error: Hashtag limit of 30 unique hashtags per week has been reached.', 'instagram-feed' ) . ' ' . sprintf( __( 'Feed may not display until %s.', 'instagram-feed' ), date_i18n( $date_time_format, $this->business_accounts[ 0 ]['hashtag_limit_reached'] + (7*24*60*60) ) ) . '</b>';
							$error .= '<p>' . __( 'If you need to display more than 30 hashtag feeds on your site, consider connecting an additional business account from a separate Instagram and Facebook account.', 'instagram-feed' );

							$sb_instagram_posts_manager->add_frontend_error( 'hashtag_limit_reached', $error );
						}


						if ( $hashtag_id ) {
							$connected_accounts_in_feed[ $hashtag_id ] = $connected_business_account;
							$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ][] = array(
								'term' => $hashtag_id,
								'params' => array( 'hashtag_id' => $hashtag_id ),
								'hashtag_name' => $hashtag
							);
						}
					}
				}

				if ( ! empty( $new_hashtag_ids ) ) {
					SB_Instagram_Settings_Pro::update_hashtag_ids( $new_hashtag_ids );
				}

				if ( empty( $hashtags ) ) {
					$error = '<p><b>' . __( 'Error: No hashtags set.', 'instagram-feed' ) . '</b> ' . __( 'Please visit the plugin\'s settings page to enter a hashtag or add one to the shortcode - hashtag="example".', 'instagram-feed' ) . '</p>';

					$sb_instagram_posts_manager->add_frontend_error( 'no_hashtag_set', $error );
				}


			} else {
				$error = '<p><b>' . __( 'Error: There are no business accounts connected.', 'instagram-feed' ) . '</b> ' . sprintf( __( 'Please visit %s to learn how to connect a business account.', 'instagram-feed' ), '<a href="https://smashballoon.com/migrate-to-new-instagram-hashtag-api/">' . __( 'this page', 'instagram-feed' ) . '</a>' ) . '</p>';

				$sb_instagram_posts_manager->add_frontend_error( 'no_business_accounts', $error );
			}

		} elseif ( $this->settings['type'] === 'mixed' ) {

			$this->settings['sortby'] = 'alternate';
			$feed_type_and_terms = array(
				'users' => array()
			);
			$usernames_included = array();

			if ( ! empty( $this->settings['user'] ) ) {
				$user_array = is_array( $this->settings['user'] ) ? $this->settings['user'] : explode( ',', str_replace( ' ', '',  $this->settings['user'] ) );
				foreach ( $user_array as $user ) {
					$user_found = false;
					if ( isset( $this->connected_accounts[ $user ] ) ) {
						if ( ! in_array( $this->connected_accounts[ $user ]['username'], $usernames_included, true ) ) {
							$feed_type_and_terms['users'][] = array(
								'term' => $this->connected_accounts[ $user ]['user_id'],
								'params' => array()
							);
							$connected_accounts_in_feed[ $this->connected_accounts[ $user ]['user_id'] ] = $this->connected_accounts[ $user ];
							$usernames_included[] = $this->connected_accounts[ $user ]['username'];
						}
					} else {

						foreach ( $this->connected_accounts as $connected_account ) {
							if ( strtolower( $user ) === strtolower( $connected_account['username'] ) ) {
								if ( ! in_array( $connected_account['username'], $usernames_included, true ) ) {
									if ( isset( $connected_account['type'] ) && $connected_account['type'] === 'business' ) {
										$feed_type_and_terms['users'][]      = array(
											'term' => $user,
											'params' => array()
										);
										$connected_accounts_in_feed[ $user ] = $connected_account;
									} else {
										$feed_type_and_terms['users'][]                              = array(
											'term' => $connected_account['user_id'],
											'params' => array()
										);
										$connected_accounts_in_feed[ $connected_account['user_id'] ] = $connected_account;
									}
									$usernames_included[] = $connected_account['username'];
									$user_found = true;
								}
							}
						}

						if ( ! $user_found ) {
							$error = '<p><b>' . sprintf( __( 'Error: There is no connected account for the user %s.', 'instagram-feed' ), $user ) . ' ' . __( 'Feed will not update.', 'instagram-feed' ) . '</b>';

							$sb_instagram_posts_manager->add_frontend_error( 'no_connection_' . $user, $error );
						}

					}

				}

			} elseif ( ! empty( $this->settings['id'] ) ) {
				$user_id_array = is_array( $this->settings['id'] ) ? $this->settings['id'] : explode( ',', str_replace( ' ', '',  $this->settings['id'] ) );

				foreach ( $user_id_array as $user ) {
					$user_found = false;

					if ( isset( $this->connected_accounts[ $user ] ) ) {
						if ( ! in_array( $this->connected_accounts[ $user ]['username'], $usernames_included, true ) ) {
							$feed_type_and_terms['users'][]                                              = array(
								'term' => $this->connected_accounts[ $user ]['user_id'],
								'params' => array()
							);
							$connected_accounts_in_feed[ $this->connected_accounts[ $user ]['user_id'] ] = $this->connected_accounts[ $user ];
							$usernames_included[]                                                        = $this->connected_accounts[ $user ]['username'];
						}

					} else {

						foreach ( $this->connected_accounts as $connected_account ) {
							if ( strtolower( $user ) === strtolower( $connected_account['username'] ) ) {
								if ( ! in_array( $this->connected_accounts[ $user ]['username'], $usernames_included, true ) ) {
									if ( isset( $connected_account['type'] ) && $connected_account['type'] === 'business' ) {
										$feed_type_and_terms['users'][]      = array(
											'term' => $user,
											'params' => array()
										);
										$connected_accounts_in_feed[ $user ] = $connected_account;
									} else {
										$feed_type_and_terms['users'][]                              =  array(
											'term' => $connected_account['user_id'],
											'params' => array()
										);
										$connected_accounts_in_feed[ $connected_account['user_id'] ] = $connected_account;
									}
									$usernames_included[] = $this->connected_accounts[ $user ]['username'];
									$user_found           = true;
								}
							}
						}

						if ( ! $user_found ) {
							$error = '<p><b>' . sprintf( __( 'Error: There is no connected account for the user %s', 'instagram-feed' ), $user ) . ' ' . __( 'Feed will not update.', 'instagram-feed' ) . '</b>';

							$sb_instagram_posts_manager->add_frontend_error( 'no_connection_' . $user, $error );
						}

					}

				}

			}

			$hashtag_order_suffix = $this->settings['order'] === 'recent' ? 'recent' : 'top';
			$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ] = array();

			$hashtags = is_array( $this->settings['hashtag'] ) ? $this->settings['hashtag'] : explode( ',', str_replace( array( ' ', '#' ), '', $this->settings['hashtag'] ) );
			$saved_hashtag_ids = SB_Instagram_Settings_Pro::get_hashtag_ids();

			foreach ( $this->connected_accounts as $connected_account ) {

				if ( isset( $connected_account['type'] ) && $connected_account['type'] === 'business' ) {
					$this->business_accounts[] = $connected_account;
				}
			}

			if ( ! empty( $this->business_accounts ) ) {
				$new_hashtag_ids = array();
				$connected_business_account = $this->business_accounts[0];
				foreach ( $hashtags as $hashtag ) {
					if ( ! empty( $hashtag ) ) {
						$hashtag_id = false;
						if ( isset( $saved_hashtag_ids[ $hashtag ] ) ) {
							$hashtag_id = $saved_hashtag_ids[ $hashtag ];
						} else {
							$i = 0;
							$error_that_isnt_18 = false;
							$new_id_set = false;

							while ( isset( $this->business_accounts[ $i ] ) && ! $new_id_set && ! $error_that_isnt_18 ) {

								if ( ! isset( $this->business_accounts[ $i ]['hashtag_limit_reached'] ) || $this->business_accounts[ $i ]['hashtag_limit_reached'] < time() - (7*24*60*60) ) {
									if ( isset( $this->business_accounts[ $i ]['hashtag_limit_reached'] ) ) {
										SB_Instagram_Settings_Pro::clear_hashtag_limit_reached( $this->business_accounts[ $i ] );
									}
									$maybe_hashtag_id = SB_Instagram_Settings_Pro::get_remote_hashtag_id_from_hashtag_name( $hashtag, $this->business_accounts[ $i ] );

									if ( $maybe_hashtag_id === 'error_18' ) {
									} elseif ( $maybe_hashtag_id !== 'error_18' && $maybe_hashtag_id !== false ) {
										$hashtag_id = $maybe_hashtag_id;
										$new_hashtag_ids[ $hashtag ] = $hashtag_id;
										$new_id_set = true;
										$connected_business_account = $this->business_accounts[ $i ];
									} else {
										if ( $maybe_hashtag_id === 'error_18' ) {
											$error_that_isnt_18 = false;
										} else {
											$error_that_isnt_18 = true;
										}
									}

								}

								$i++;
							}

						}

						if ( $hashtag_id ) {
							$connected_accounts_in_feed[ $hashtag_id ] = $connected_business_account;
							$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ][] = array(
								'term' => $hashtag_id,
								'params' => array( 'hashtag_id' => $hashtag_id ),
								'hashtag_name' => $hashtag
							);
						}
					}
				}

				if ( ! empty( $new_hashtag_ids ) ) {
					SB_Instagram_Settings_Pro::update_hashtag_ids( $new_hashtag_ids );
				}

				if ( empty( $hashtags ) ) {
					$error = '<p><b>' . __( 'Error: No hashtags set.', 'instagram-feed' ) . '</b> ' . __( 'Please visit the plugin\'s settings page to enter a hashtag or add one to the shortcode - hashtag="example".', 'instagram-feed' ) . '</p>';

					$sb_instagram_posts_manager->add_frontend_error( 'no_hashtag_set', $error );
				} elseif ( empty( $feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ] ) ) {
					$error = '<p><b>' . __( 'Error: Hashtag limit of 30 unique hashtags per week has been reached.', 'instagram-feed' ) . '</b>';
					$error .= '<p>' . __( 'If you need to display more than 30 hashtag feeds on your site, consider connecting an additional business account from a separate Instagram and Facebook account.', 'instagram-feed' );

					$sb_instagram_posts_manager->add_frontend_error( 'hashtag_limit_reached', $error );
				}
			} else {
				$error = '<p><b>' . __( 'Error: There are no business accounts connected.', 'instagram-feed' ) . '</b> ' . sprintf( __( 'Please visit %s to learn how to connect a business account.', 'instagram-feed' ), '<a href="https://smashballoon.com/migrate-to-new-instagram-hashtag-api/">' . __( 'this page', 'instagram-feed' ) . '</a>' ) . '</p>';

				$sb_instagram_posts_manager->add_frontend_error( 'no_business_accounts', $error );
			}

		} else {
			$error = '<p><b>' . __( 'Error: No feed type selected.', 'instagram-feed' ) . '</b> ' . sprintf( __( 'Please use a feed type of "user", "hashtag", or "mixed".', 'instagram-feed' ), '<a href="https://smashballoon.com/migrate-to-new-instagram-hashtag-api/">' . __( 'this page', 'instagram-feed' ) . '</a>' ) . '</p>';

			$sb_instagram_posts_manager->add_frontend_error( 'no_type', $error );
		}

		$this->connected_accounts_in_feed = $connected_accounts_in_feed;
		$this->feed_type_and_terms = $feed_type_and_terms;
	}

	/**
	 * Each hashtag has an ID associated with it. This must be retrieved first to
	 * get any posts associated with the hashtag.
	 *
	 * @param $hashtag
	 * @param $account
	 *
	 * @return bool|string
	 *
	 * @since 5.0
	 */
	public static function get_remote_hashtag_id_from_hashtag_name( $hashtag, $account ) {
		$connection = new SB_Instagram_API_Connect_Pro( $account, 'ig_hashtag_search', array( 'hashtag' => $hashtag ) );

		$connection->connect();

		if ( ! $connection->is_wp_error() && ! $connection->is_instagram_error() ) {
			$data = $connection->get_data();
			if ( isset( $data[0] ) ) {
				return $data[0]['id'];
			} else {
				return false;
			}
		} else {
			if ( $connection->is_wp_error() ) {
				SB_Instagram_API_Connect_Pro::handle_wp_remote_get_error( $connection->get_wp_error() );
			} else {
				SB_Instagram_API_Connect_Pro::handle_instagram_error( $connection->get_data(), $account, 'ig_hashtag_search' );
				$response = $connection->get_data();

				if ( (int)$response['error']['code'] === 18 ) {
					return 'error_18';
				}
			}

			return false;
		}

	}

	/**
	 * Hashtag IDs are stored locally to avoid the extra API call
	 *
	 * @return array
	 *
	 * @since 5.0
	 */
	public static function get_hashtag_ids() {
		return get_option( 'sbi_hashtag_ids', array() );
	}

	/**
	 * Stores the retrieved hashtag ID locally using hashtag => hashtag ID
	 * key value pair
	 *
	 * @param $hashtag_name_id_pairs
	 *
	 * @since 5.0
	 */
	public static function update_hashtag_ids( $hashtag_name_id_pairs ) {
		$existing = get_option( 'sbi_hashtag_ids', array() );

		$new = array_merge( $existing, $hashtag_name_id_pairs );

		update_option( 'sbi_hashtag_ids', $new, false );
	}

	/**
	 * Clears the marker for the hashtag limit being reached for a connected account
	 * since this expires after a week.
	 *
	 * @param $account
	 *
	 * @since 5.0
	 */
	public static function clear_hashtag_limit_reached( $account ) {
		$options = get_option( 'sb_instagram_settings', array() );

		$connected_accounts =  isset( $options['connected_accounts'] ) ? $options['connected_accounts'] : array();

		foreach ( $connected_accounts as $key => $connected_account ) {
			if ( isset( $connected_accounts[ $key ]['hashtag_limit_reached'] ) ) {
				unset( $connected_accounts[ $key ]['hashtag_limit_reached'] );
			}

		}

		$options['connected_accounts'] = $connected_accounts;

		update_option( 'sb_instagram_settings', $options );
	}
}