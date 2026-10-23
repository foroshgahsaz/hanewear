<?php

namespace Modista\Plugins;

class Google_Api_Client {

    private $clientID;
    private $clientSecret;
    private $redirectUri;

	public function __construct(string $clientID, string $clientSecret, string $redirectUri)
	{
		$this->clientID = $clientID;
		$this->clientSecret = $clientSecret;
		$this->redirectUri = $redirectUri;
	}

	/**
	 * Auth with Google identy service 
	 */
	public function oauth2_token_info($jwt_token)
	{
		$base = 'https://oauth2.googleapis.com/tokeninfo?id_token=';
		$ch = curl_init($base . $jwt_token);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		$user_info = json_decode($response, true);

		if (isset($user_info['aud']) && $user_info['aud'] === $this->clientID) {
			return $user_info;
		} else {
			return false;
		}		
	}

	/**
	 * render Auth button with Google identy service 
	 */
	public function render_gis_button ()
	{
		?>
		<div id="g_id_onload"
			data-client_id="<?php esc_html_e( $this->clientID ) ?>"
			data-context="signin"
			data-ux_mode="popup"
			data-callback="gis_login"
			data-auto_prompt="false"
			data-use_fedcm_for_prompt="true"
			>
		</div>
		<div class="g_id_signin"
			data-type="standard"
			data-shape="rectangular"
			data-theme="filled_black"
			data-text="signin_with"
			data-size="large"
			data-locale="fa"
			data-width="380"
			>
		</div>
		<?php	
	}

	public function render_gapi_button ()
	{
	?>
		<!-- In the callback, you would hide the gSignInWrapper element on a successful sign in -->
		<div id="gSignInWrapper" class="google-login__wrapper">
			<div id="gapi_signin_button" class="google-login__btn">
				<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_481_10090)">
					<path d="M13.0198 26C20.2104 26 26.0396 20.1797 26.0396 13C26.0396 5.8203 20.2104 0 13.0198 0C5.82917 0 0 5.8203 0 13C0 20.1797 5.82917 26 13.0198 26Z" fill="#E0E0E0"/>
					<path d="M13.0198 25.6049C20.1012 25.6049 25.8417 19.873 25.8417 12.8024C25.8417 5.73184 20.1012 0 13.0198 0C5.93845 0 0.197876 5.73184 0.197876 12.8024C0.197876 19.873 5.93845 25.6049 13.0198 25.6049Z" fill="white"/>
					<mask id="mask0_481_10090" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="4" y="4" width="18" height="18">
					<path d="M21.3303 11.3009H13.2177V14.6595H17.8874C17.452 16.7933 15.6317 18.0182 13.2177 18.0182C10.3683 18.0182 8.07306 15.7264 8.07306 12.8814C8.07306 10.0364 10.3683 7.74465 13.2177 7.74465C14.4444 7.74465 15.5525 8.17931 16.4231 8.89055L18.9559 6.36167C17.4125 5.0182 15.4338 4.18842 13.2177 4.18842C8.38965 4.18842 4.51141 8.06076 4.51141 12.8814C4.51141 17.7021 8.38965 21.5744 13.2177 21.5744C17.5708 21.5744 21.5282 18.4133 21.5282 12.8814C21.5282 12.3677 21.449 11.8146 21.3303 11.3009Z" fill="white"/>
					</mask>
					<g mask="url(#mask0_481_10090)">
					<path d="M3.71994 18.0182V7.74463L10.4475 12.8814L3.71994 18.0182Z" fill="#FBBC05"/>
					</g>
					<mask id="mask1_481_10090" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="4" y="4" width="18" height="18">
					<path d="M21.3303 11.3009H13.2177V14.6595H17.8874C17.452 16.7933 15.6317 18.0182 13.2177 18.0182C10.3683 18.0182 8.07306 15.7264 8.07306 12.8814C8.07306 10.0364 10.3683 7.74465 13.2177 7.74465C14.4444 7.74465 15.5525 8.17931 16.4231 8.89055L18.9559 6.36167C17.4125 5.0182 15.4338 4.18842 13.2177 4.18842C8.38965 4.18842 4.51141 8.06076 4.51141 12.8814C4.51141 17.7021 8.38965 21.5744 13.2177 21.5744C17.5708 21.5744 21.5282 18.4133 21.5282 12.8814C21.5282 12.3677 21.449 11.8146 21.3303 11.3009Z" fill="white"/>
					</mask>
					<g mask="url(#mask1_481_10090)">
					<path d="M3.71994 7.74464L10.4475 12.8814L13.2177 10.4711L22.7154 8.93005V3.39813H3.71994V7.74464Z" fill="#EA4335"/>
					</g>
					<mask id="mask2_481_10090" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="4" y="4" width="18" height="18">
					<path d="M21.3303 11.3009H13.2177V14.6595H17.8874C17.452 16.7933 15.6317 18.0182 13.2177 18.0182C10.3683 18.0182 8.07306 15.7264 8.07306 12.8814C8.07306 10.0364 10.3683 7.74465 13.2177 7.74465C14.4444 7.74465 15.5525 8.17931 16.4231 8.89055L18.9559 6.36167C17.4125 5.0182 15.4338 4.18842 13.2177 4.18842C8.38965 4.18842 4.51141 8.06076 4.51141 12.8814C4.51141 17.7021 8.38965 21.5744 13.2177 21.5744C17.5708 21.5744 21.5282 18.4133 21.5282 12.8814C21.5282 12.3677 21.449 11.8146 21.3303 11.3009Z" fill="white"/>
					</mask>
					<g mask="url(#mask2_481_10090)">
					<path d="M3.71994 18.0182L15.5921 8.93005L18.7184 9.32518L22.7154 3.39813V22.3647H3.71994V18.0182Z" fill="#34A853"/>
					</g>
					<mask id="mask3_481_10090" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="4" y="4" width="18" height="18">
					<path d="M21.3303 11.3009H13.2177V14.6595H17.8874C17.452 16.7933 15.6317 18.0182 13.2177 18.0182C10.3683 18.0182 8.07306 15.7264 8.07306 12.8814C8.07306 10.0364 10.3683 7.74465 13.2177 7.74465C14.4444 7.74465 15.5525 8.17931 16.4231 8.89055L18.9559 6.36167C17.4125 5.0182 15.4338 4.18842 13.2177 4.18842C8.38965 4.18842 4.51141 8.06076 4.51141 12.8814C4.51141 17.7021 8.38965 21.5744 13.2177 21.5744C17.5708 21.5744 21.5282 18.4133 21.5282 12.8814C21.5282 12.3677 21.449 11.8146 21.3303 11.3009Z" fill="white"/>
					</mask>
					<g mask="url(#mask3_481_10090)">
					<path d="M22.7154 22.3647L10.4475 12.8814L8.86453 11.696L22.7154 7.74463V22.3647Z" fill="#4285F4"/>
					</g>
					</g>
					<defs>
					<clipPath id="clip0_481_10090">
					<rect width="26" height="26" fill="white"/>
					</clipPath>
					</defs>
				</svg>
				<span class="buttonText">ورود به سیستم با گوگل</span>
			</div>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', () => {
				const gapi_start = function() {
					gapi.load('auth2', function() {
						// Retrieve the singleton for the GoogleAuth library and set up the client.
						auth2 = gapi.auth2.init({
							client_id: '<?php esc_html_e( $this->clientID ) ?>',
							cookiepolicy: 'single_host_origin',
							use_fedcm: true
						});
						attachSignin(document.getElementById('gapi_signin_button'));
					});
				};		
				// handle login and click listener for gapi method - Deprecated
				const googleUser = {};
				// handle login and click listener for gapi method - Deprecated
				function attachSignin(element) {
					auth2.attachClickHandler(element, {}, 
						function(googleUser) {						
							gis_login(googleUser.getAuthResponse().id_token)
						}, function(error) {
							// console.log(JSON.stringify(error, undefined, 2));
						}
					);
				}

				gapi_start();
			});			
		</script>
	<?php	
	}
}