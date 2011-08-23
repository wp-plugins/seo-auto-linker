<?php
class pmgSeoAutoLinkerFront
{
	function __construct()
	{
		add_filter( 'the_content', array( &$this, 'content' ), 99, 1 );
	}
	
	function content( $content )
	{
		if( ! is_singular() ) return $content;
		global $post;
		
		// If there's persistent caching set up on the server, this will work!
		if( $filtered_content = wp_cache_get( 'autolinker_content_' . $post->ID, 'autolinker_content' ) )
			return $filter_content;
		
		// set up some more options
		$opts = get_option( 'pmg_autolinker_options' );
		$kws = isset( $opts['kw'] ) ? (array) $opts['kw'] : array();
		if( empty( $kws ) ) return $content;
		
		// Find all of our <h> tags in the content and replace them with something
		preg_match_all( '/<h[1-6]>.+?<\/h[1-6]>/', $content, $headers );
		if( $headers[0] )
		{
			$headers_replacements = array();
			$counter = 0;
			foreach( $headers[0] as $h )
			{
				$headers_replacements[$h] = "!!!!--seo-auto-links-header-{$counter}--!!!!";
				$counter++;
			}
			$filtered_content = str_replace( array_keys( $headers_replacements ), array_values( $headers_replacements ), $content );
		}
		else
		{
			$filtered_content = $content;
		}
		
		// Add our links
		$link_counter = 0;
		$links_replacements = array();
		foreach( $kws as $index => $kw )
		{
			$nope = isset( $opts[$post->post_type][$index] ) && 'off' == $opts[$post->post_type][$index] ? true : false;
			if( $nope ) continue;
			
			$url = isset( $opts['url'][$index] ) ? $opts['url'][$index] : false;
			if( ! $url ) continue;
			
			$max = isset( $opts['max'][$index] ) ? $opts['max'][$index] : 1;
			
			// Find all the links in the content so we don't overwrite them or get weird stuff
			preg_match_all( '/<a(.*?)href="(.*?)"(.*?)>(.*?)<\/a>/', $filtered_content, $links );
			if( $links[0] )
			{
				$temp_links = array();
				foreach( $links[0] as $l )
				{
					$temp_links["!!!!--seo-auto-links-link-{$link_counter}--!!!!"] = $l;
					$link_counter++;
				}
				$filtered_content = str_replace( array_values( $temp_links ), array_keys( $temp_links ), $filtered_content );
				$links_replacements = array_merge( $links_replacements, $temp_links );
			}
			
			// Finally! add our links via preg_replace
			$regex = implode( '|', array_map( 'esc_attr', array_map( 'trim', explode( ',', $kw ) ) ) );
			$filtered_content = preg_replace( '/(' . $regex . ')/i', '<a href="' . esc_url( $url ) . '" title="$1">$1</a>', $filtered_content, absint( $max ) );
		}
		
		// Put the original <h> tags back in
		if( $headers[0] )
			$filtered_content = str_replace( array_values( $headers_replacements ), array_keys( $headers_replacements ), $filtered_content );
		
		// Put links back in
		if( ! empty( $links_replacements ) )
			$filtered_content = str_replace( array_keys( $links_replacements ), array_values( $links_replacements ), $filtered_content );
		
		// set the cache for those folks using persistent caching
		wp_cache_set( 'autolinker_content_' . $post->ID, $filtered_content, 'autolinker_content' );
		
		return $filtered_content;
	}
} // end class;

new pmgSeoAutoLinkerFront();