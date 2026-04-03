<?php
/**
 * MS Graph Core Handler — Skeleton v6 (v9.1)
 * Handles OAuth2 Multi-tenant Authentication and API Calls.
 */

class MsGraph {
    private $clientId;
    private $clientSecret;
    private $tenantId;
    private $redirectUri;
    private $scope;

    public function __construct($clientId, $clientSecret, $redirectUri, $tenantId = 'common') {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
        $this->tenantId = $tenantId;
        $this->scope = "https://graph.microsoft.com/.default openid profile offline_access";
    }

    /** 1. Get Login URL */
    public function getLoginUrl() {
        $url = "https://login.microsoftonline.com/{$this->tenantId}/oauth2/v2.0/authorize?";
        $params = [
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'redirect_uri' => $this->redirectUri,
            'response_mode' => 'query',
            'scope' => $this->scope,
            'state' => bin2hex(random_bytes(16))
        ];
        $_SESSION['ms_auth_state'] = $params['state'];
        return $url . http_build_query($params);
    }

    /** 2. Trade Code for Token */
    public function getTokenFromCode($code) {
        $url = "https://login.microsoftonline.com/{$this->tenantId}/oauth2/v2.0/token";
        $data = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code',
            'scope' => $this->scope
        ];
        return $this->postRequest($url, $data);
    }

    /** 3. Refresh Token */
    public function refreshToken($refreshToken) {
        $url = "https://login.microsoftonline.com/{$this->tenantId}/oauth2/v2.0/token";
        $data = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
            'scope' => $this->scope
        ];
        return $this->postRequest($url, $data);
    }

    /** 4. Generic Graph API Call */
    public function graphCall($endpoint, $accessToken, $method = 'GET', $body = null) {
        $url = "https://graph.microsoft.com/v1.0/" . ltrim($endpoint, '/');
        $headers = [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($body) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'status' => $httpCode,
            'data' => json_decode($response, true)
        ];
    }

    private function postRequest($url, $data) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'status' => $httpCode,
            'data' => json_decode($response, true)
        ];
    }
}
?>
