<?php

namespace Hardywen\UcpaasSms;

trait HelperTrait
{

    /**
     * 构造curl请求header
     * @return array
     */
    public function getHeader()
    {
        $sid = $this->config['sid'];
        $time = $this->time;
        $authorization = base64_encode($sid . ':' . $time);

        $header = array(
            'Host:api.ucpaas.com',
            'Accept:application/json',
            'Content-Type:application/json;charset=utf-8',
            'Authorization:' . $authorization
        );

        return $header;
    }

    /**
     * curl get
     * @param $url
     * @param $data
     * @return mixed
     */
    public function getJson($url, $data)
    {

        $curl = curl_init($url . '&' . http_build_query($data));

        curl_setopt($curl, CURLOPT_HEADER, $this->getHeader());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $responseText = curl_exec($curl);

        curl_close($curl);

        return $responseText;

    }

    /**
     * curl post
     * @param $url
     * @param $data
     * @return mixed
     */
    public function postJson($url, $data)
    {

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeader());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $responseText = curl_exec($curl);

        curl_close($curl);

        return $responseText;
    }

    /**
     * 构造请求链接
     * @param $uri
     * @return string
     */
    public function getRequestUrl($uri)
    {
        $sid = $this->config['sid'];
        $time = $this->time;
        $token = $this->config['token'];
        $sign = strtoupper(md5($sid . $token . $time));


        $url = "{$this->config['restUrl']}/{$this->config['softVersion']}/Accounts/{$this->config['sid']}/{$uri}?sig={$sign}";

        return $url;
    }

    /**
     * 以Get方式请求api
     * @param $uri
     * @param $data
     * @return mixed
     */
    public function responseGet($uri, $data)
    {
        $url = $this->getRequestUrl($uri);

        $response = $this->getJson($url, $data);

        return json_decode($response);

    }

    /**
     * 以Post方式请求api
     * @param $uri
     * @param $data
     * @return mixed
     */
    public function responsePost($uri, $data)
    {
        $url = $this->getRequestUrl($uri);

        $response = $this->postJson($url, $data);

        return json_decode($response);
    }
}