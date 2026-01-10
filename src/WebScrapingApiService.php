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
     * Scrape a webpage and extract structured content, metadata, and key page elements.
     *
     * Returns comprehensive data including:
     * - Page title, description, keywords
     * - Meta tags (Open Graph, Twitter cards)
     * - Structured content (headings, paragraphs)
     * - Links (internal and external)
     * - Language detection
     * - Timestamps
     *
     * @param string $url The URL of the webpage to scrape (required)
     * @return array The scraped content with structured metadata
     *
     * @throws GuzzleException
     *
     * @api
     */
    public function scrapeWebpage(string $url): array
    {
        $response = $this->makeGetRequest('/utilities/scrape_url', ['url' => $url]);

        return json_decode((string) $response->getBody(), true);
    }

}