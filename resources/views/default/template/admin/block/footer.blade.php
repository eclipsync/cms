<?php
/**
 * Created on 10 Mar 2021
 * Time Created	: 10:24:14
 *
 * @filesource	footer.blade.php
 *
 * @author		wisnuwidi@gmail.com - 2021
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */

$copyrights    = $components->meta->preference;
$author        = diy_config('meta_author');
if (!empty($copyrights['meta_author']))   $author        = $copyrights['meta_author'];
$copyright     = diy_config('copyrights');
if (!empty($copyrights['meta_author']))   $copyright     = $copyrights['meta_author'];
$email_address = diy_config('email');
if (!empty($copyrights['email_address'])) $email_address = $copyrights['email_address'];
?>
			<!-- FOOTER OPEN  -->
			<footer>
				<div class="footer-area blury">
					<span class="pull-right">
						<span id="copyright"></span>&nbsp;
						<font title="{{ $author }} <{{ $email_address }}>">&copy;</font>&nbsp;
						<a href="mailto:{{ $email_address }}" target="_blank">{{ $copyright }}</a>, {{ diy_config('location') }} {{ diy_config('location_abbr') }}
					</span>
				</div>
			</footer>
			<!-- FOOTER CLOSE -->