<?php

declare(strict_types=1);

namespace SharpAPI\WebScrapingApi;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use SharpAPI\Core\Client\SharpApiClient;

/**
 * @api
 */
class WebScrapingApiService extends SharpApiClient
{
    /**
     * Initializes a new instance of the class.
     *
     * @throws InvalidArgumentException if the API key is empty.
     */
    public function __construct()
    {
        parent::__construct(config('sharpapi-web-scraping-api.api_key'));
        $this->setApiBaseUrl(
            config(
                'sharpapi-web-scraping-api.base_url',
                'https://sharpapi.com/api/v1'
            )
        );
        $this->setUserAgent('SharpAPILaravelWebScrapingApi/1.0.0');
    }

    /**
     * Scrape a webpage and extract its HTML content.
     *
     * @param string $url The URL of the webpage to scrape
     * @param array $options Additional options for the scraping request
     * @return array The scraped HTML content and metadata
     *
     * @throws GuzzleException
     *
     * @api
     */
    public function scrapeWebpage(string $url, array $options = []): array
    {
        $params = array_merge(['url' => $url], $options);

        $response = $this->makeRequest(
            'GET',
            '/utility/web-scraping/html',
            $params
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Extract structured data from a webpage.
     *
     * @param string $url The URL of the webpage to extract data from
     * @param array $selectors CSS selectors to extract specific elements
     * @param array $options Additional options for the extraction request
     * @return array The extracted structured data
     *
     * @throws GuzzleException
     *
     * @api
     */
    public function extractStructuredData(string $url, array $selectors, array $options = []): array
    {
        $params = array_merge(
            [
                'url' => $url,
                'selectors' => $selectors,
            ],
            $options
        );

        $response = $this->makeRequest(
            'POST',
            '/utility/web-scraping/extract',
            $params
        );

        return json_decode((string) $response->getBody(), true);
    }


    /**
     * Extract all links from a webpage.
     *
     * @param string $url The URL of the webpage to extract links from
     * @param array $options Additional options for the link extraction request
     * @return array The extracted links
     *
     * @throws GuzzleException
     *
     * @api
     */
    public function extractLinks(string $url, array $options = []): array
    {
        $params = array_merge(['url' => $url], $options);

        $response = $this->makeRequest(
            'GET',
            '/utility/web-scraping/links',
            $params
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Extract all images from a webpage.
     *
     * @param string $url The URL of the webpage to extract images from
     * @param array $options Additional options for the image extraction request
     * @return array The extracted images
     *
     * @throws GuzzleException
     *
     * @api
     */
    public function extractImages(string $url, array $options = []): array
    {
        $params = array_merge(['url' => $url], $options);

        $response = $this->makeRequest(
            'GET',
            '/utility/web-scraping/images',
            $params
        );

        return json_decode((string) $response->getBody(), true);
    }
}