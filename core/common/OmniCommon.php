<?php

class OmniCommon {

	public static function omni_wp_theme_get_new_ticker_content() {
		$tickers = self::omni_wp_theme_news_ticker_details();
		if ( empty( $tickers ) ) {
			return;
		}

		ob_start();
		?>
		<div id="news-ticker" style="display: inline-block;">
			<div class="news-ticker-inner-wrap">
				<?php foreach ( $tickers as $key => $ticker ) : ?>
					<div class="list">
						<a href="<?php echo esc_url( $ticker['link'] ); ?>"><?php echo esc_html( $ticker['text'] ); ?></a>
					</div>
				<?php endforeach ?>
			</div> <!-- .news-ticker-inner-wrap -->
		</div><!-- #news-ticker -->
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	public static function omni_wp_theme_news_ticker_details() {

		$output = array();

		$ticker_category = OmniCore::omni_wp_theme_get_option( 'ticker_category' );
		$ticker_number   = OmniCore::omni_wp_theme_get_option( 'ticker_number' );

		$qargs = array(
			'posts_per_page' => absint( $ticker_number ),
			'no_found_rows'  => true,
			'post_type'      => 'post',
		);
		if ( absint( $ticker_category ) > 0 ) {
			$qargs['category'] = absint( $ticker_category );
		}

		$all_posts = get_posts( $qargs );

		if ( $all_posts ) {
			$i = 0;
			foreach ( $all_posts as $post ) {
				$output[$i]['text'] = apply_filters( 'the_title', $post->post_title );
				$output[$i]['link'] = get_permalink( $post->ID );
				$i++;
			}
		}

		return $output;

	}

}