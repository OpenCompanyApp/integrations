<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage intelligence data for NEWS_SENTIMENT.
 */
class AlphaVantageNewsSentiment extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_news_sentiment';
    protected const FUNCTION = 'NEWS_SENTIMENT';
    protected const DESCRIPTION = 'Fetch Alpha Vantage intelligence data for NEWS_SENTIMENT.

Official Alpha Vantage function: NEWS_SENTIMENT.';
    protected const REQUIRED = array (
);
    protected const PARAMETERS = array (
  'tickers' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Stock, crypto, or forex tickers such as IBM or CRYPTO:BTC.',
  ),
  'topics' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Comma-separated Alpha Vantage news topics.',
  ),
  'time_from' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Earliest article time in YYYYMMDDTHHMM format.',
  ),
  'time_to' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Latest article time in YYYYMMDDTHHMM format.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Sort mode such as LATEST, EARLIEST, or RELEVANCE.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum article count.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
