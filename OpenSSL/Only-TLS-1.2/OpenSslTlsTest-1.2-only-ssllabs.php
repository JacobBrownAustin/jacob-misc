<?php
/*
 * This test verifies that only TLS 1.2 will work when connecting to various SSL & TLS ports.
 * This test will only pass if you have configured libssl to have the other versions disabled.
 * This test proves that OpenSSL currently has a bug when disabling TLS 1.0 and 1.1.
 * This test will fail unless you use a patched version of OpenSSL to fix this.
 * You can find my example packages here that have all versions except TLS 1.2 disabled:
 * https://github.com/JacobBrownAustin/jacob-misc/tree/master/OpenSSL/Only-TLS-1.2
 */

    class OpenSslTlsTest extends \PHPUnit\Framework\TestCase
    {

        private $debug = true;
        // Note: looks like SSL Lab's uses the hex version 301 in the decimal port 10301 :-)
        // Note: The "normal" server currently has TLS 1.0, 1.1, and 1.2 enabled.  It doesn't allow SSL.
        private function normalendpoint() { return 'https://www.ssllabs.com/plaintext/1x1-transparent.png?t=' . (string)(time() * 1000); } //1514148178188';
        private function tls10endpoint()  { return 'https://www.ssllabs.com:10301/1x1-transparent.png?t=' . (string)(time() * 1000); } //1514148178188';
        private function tls11endpoint()  { return 'https://www.ssllabs.com:10302/1x1-transparent.png?t=' . (string)(time() * 1000); } //1514148178188';
        private function tls12endpoint()  { return 'https://www.ssllabs.com:10303/1x1-transparent.png?t=' . (string)(time() * 1000); } //1514148178188';
        private function ssl30endpoint()  { return 'https://www.ssllabs.com:10300/1x1-transparent.png?t=' . (string)(time() * 1000); } //1514148178188';
        // TODO: Not sure about this one:
        // private $ssl2endpoint  = 'https://www.ssllabs.com:10200/1x1-transparent.png?t=1514148178188';

        // Server versions to test:
        private $testNormalServer = "Normal server";
        private $testSsl2Server   = "SSL 2.0 Test Server";
        private $testSsl3Server   = "SSL 3.0 Test Server";
        private $testTls10Server  = "TLS 1.0 Test Server";
        private $testTls11Server  = "TLS 1.1 Test Server";
        private $testTls12Server  = "TLS 1.2 Test Server";
        private $testTls13Server  = "TLS 1.3 Test Server";

        // Client versions to test:
        private $testUnspecifiedClient = "Unspecified version Client";
        private $testSsl2Client   = "SSL 2.0 Client";
        private $testSsl3Client   = "SSL 3.0 Client";
        private $testTls10Client  = "TLS 1.0 Client";
        private $testTls11Client  = "TLS 1.1 Client";
        private $testTls12Client  = "TLS 1.2 Client";
        private $testTls13Client  = "TLS 1.3 Client";

        // Should it work or error
        private $shouldWork = "Should Work";
        private $shouldError = "Should Error";

        /**
         * @inheritdoc
         */
        public function setUp()
        {
        }

        public function versionProvider() {
            return [

                [ $this->testNormalServer, $this->testUnspecifiedClient, $this->shouldWork ],
                [ $this->testNormalServer, $this->testSsl2Client       , $this->shouldError ],
                [ $this->testNormalServer, $this->testSsl3Client       , $this->shouldError ],
                [ $this->testNormalServer, $this->testTls10Client      , $this->shouldError ],
                [ $this->testNormalServer, $this->testTls11Client      , $this->shouldError ],
                [ $this->testNormalServer, $this->testTls12Client      , $this->shouldWork ],
                // [ $this->testNormalServer, $this->testTls13Client      , $this->shouldError? ],

                [ $this->testSsl3Server, $this->testUnspecifiedClient, $this->shouldError ],
                [ $this->testSsl3Server, $this->testSsl2Client       , $this->shouldError ],
                [ $this->testSsl3Server, $this->testSsl3Client       , $this->shouldError ],
                [ $this->testSsl3Server, $this->testTls10Client      , $this->shouldError ],
                [ $this->testSsl3Server, $this->testTls11Client      , $this->shouldError ],
                [ $this->testSsl3Server, $this->testTls12Client      , $this->shouldError ],
                // [ $this->testSsl3Server, $this->testTls13Client      , $this->shouldError ],

                [ $this->testTls10Server, $this->testUnspecifiedClient, $this->shouldError ],
                [ $this->testTls10Server, $this->testSsl2Client       , $this->shouldError ],
                [ $this->testTls10Server, $this->testSsl3Client       , $this->shouldError ],
                [ $this->testTls10Server, $this->testTls10Client      , $this->shouldError ],
                [ $this->testTls10Server, $this->testTls11Client      , $this->shouldError ],
                [ $this->testTls10Server, $this->testTls12Client      , $this->shouldError ],
                // [ $this->testTls10Server, $this->testTls13Client      , $this->shouldError ],

                [ $this->testTls11Server, $this->testUnspecifiedClient, $this->shouldError ],
                [ $this->testTls11Server, $this->testSsl2Client       , $this->shouldError ],
                [ $this->testTls11Server, $this->testSsl3Client       , $this->shouldError ],
                [ $this->testTls11Server, $this->testTls10Client      , $this->shouldError ],
                [ $this->testTls11Server, $this->testTls11Client      , $this->shouldError ],
                [ $this->testTls11Server, $this->testTls12Client      , $this->shouldError ],
                // [ $this->testTls11Server, $this->testTls13Client      , $this->shouldError ],

                [ $this->testTls12Server, $this->testUnspecifiedClient, $this->shouldWork ],
                [ $this->testTls12Server, $this->testSsl2Client       , $this->shouldError ],
                [ $this->testTls12Server, $this->testSsl3Client       , $this->shouldError ],
                [ $this->testTls12Server, $this->testTls10Client      , $this->shouldError ],
                [ $this->testTls12Server, $this->testTls11Client      , $this->shouldError ],
                [ $this->testTls12Server, $this->testTls12Client      , $this->shouldWork ],
                // [ $this->testTls12Server, $this->testTls13Client      , $this->shouldError ],

            ];
        }

        private function getUrlForTestServer($testServer) {
            switch($testServer) {
                case $this->testNormalServer:
                    $url = $this->normalendpoint();
                    break;
                //TODO:
                //case $this->testSsl2Server:
                //    $url = $this->ssl20endpoint();
                //    break;
                case $this->testSsl3Server:
                    $url = $this->ssl30endpoint();
                    break;
                case $this->testTls10Server:
                    $url = $this->tls10endpoint();
                    break;
                case $this->testTls11Server:
                    $url = $this->tls11endpoint();
                    break;
                case $this->testTls12Server:
                    $url = $this->tls12endpoint();
                    break;
                default:
                    throw \Exception("Unsupported test server version");
            }
            return $url;
        }

        /**
          * @dataProvider versionProvider
          */
        public function testPhpOpenSslExtension($testServer, $testClient, $workOrError)
        {
            $context = null;
            if ($testClient != $this->testUnspecifiedClient) {
                switch($testClient) {
                    case $this->testSsl2Client:
                        $method = STREAM_CRYPTO_METHOD_SSLv2_CLIENT;
                        break;
                    case $this->testSsl3Client:
                        $method = STREAM_CRYPTO_METHOD_SSLv3_CLIENT;
                        break;
                    case $this->testTls10Client:
                        $method = STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT;
                        break;
                    case $this->testTls11Client:
                        $method = STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT;
                        break;
                    case $this->testTls12Client:
                        $method = STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
                        break;
                    default:
                        throw \Exception("Unsupported test client version");
                }
                $context = stream_context_create(['ssl' => [
                    'crypto_method' => $method,
               ]]);
            } 
            $url = $this->getUrlForTestServer($testServer);
            try {
                $html = file_get_contents($url, FALSE, $context);
            } catch (\Exception $exception) {
                $message = $exception->getMessage();
                $this->assertTrue(
                    "file_get_contents(): SSL operation failed with code 1. OpenSSL Error messages:\nerror:141640BF:SSL routines:tls_construct_client_hello:no protocols available" == $message 
                    || "file_get_contents(): SSL operation failed with code 1. OpenSSL Error messages:\nerror:14083102:SSL routines:SSL3_CLIENT_HELLO:unsupported protocol" == $message 
                    || 'file_get_contents(): SSLv3 unavailable in the OpenSSL library against which PHP is linked' == $message
                    || "file_get_contents(): SSL operation failed with code 1. OpenSSL Error messages:\nerror:1408F10B:SSL routines:SSL3_GET_RECORD:wrong version number" == $message
                    || "file_get_contents(): SSL operation failed with code 1. OpenSSL Error messages:\nerror:14077102:SSL routines:SSL23_GET_SERVER_HELLO:unsupported protocol" == $message
                    || "file_get_contents(): SSL operation failed with code 1. OpenSSL Error messages:\nerror:14171102:SSL routines:tls_process_server_hello:unsupported protocol" == $message
                    || "file_get_contents(): SSL operation failed with code 1. OpenSSL Error messages:\nerror:1417110A:SSL routines:tls_process_server_hello:wrong ssl version" == $message
                    || "file_get_contents(): SSLv2 unavailable in the OpenSSL library against which PHP is linked" == $message

                );
                if ($workOrError != $this->shouldError) {
                    throw $exception;
                }
            }
            if ($workOrError == $this->shouldError) {
                $this->assertTrue(empty($html));
            } else {
                $this->assertFalse(empty($html));
            }
        }

        /**
          * @dataProvider versionProvider
          */
        public function testPhpCurlExtension($testServer, $testClient, $workOrError)
        {
            $curlHandle = curl_init();
            $url = $this->getUrlForTestServer($testServer);
            curl_setopt($curlHandle, CURLOPT_URL, $url);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
            if ($testClient != $this->testUnspecifiedClient) {
                switch($testClient) {
                    case $this->testSsl2Client:
                        $method = CURL_SSLVERSION_SSLv2;
                        break;
                    case $this->testSsl3Client:
                        $method = CURL_SSLVERSION_SSLv3;
                        break;
                    case $this->testTls10Client:
                        $method = CURL_SSLVERSION_TLSv1_0;
                        break;
                    case $this->testTls11Client:
                        $method = CURL_SSLVERSION_TLSv1_1;
                        break;
                    case $this->testTls12Client:
                        $method = CURL_SSLVERSION_TLSv1_2;
                        break;
                    default:
                        throw \Exception("Unsupported test client version");
                }
                curl_setopt($curlHandle, CURLOPT_SSLVERSION, $method);
            } 
            $curlSucceeded = curl_exec($curlHandle);
            curl_close($curlHandle);
            if ($workOrError == $this->shouldError) {
                $this->assertFalse($curlSucceeded);
            } else {
                $this->assertTrue(false !== $curlSucceeded && !empty($curlSucceeded));
            }
        }

    }
