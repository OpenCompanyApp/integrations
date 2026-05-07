<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage intelligence data for EARNINGS_CALL_TRANSCRIPT.
 */
class AlphaVantageEarningsCallTranscript extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_earnings_call_transcript';
    protected const FUNCTION = 'EARNINGS_CALL_TRANSCRIPT';
    protected const DESCRIPTION = 'Fetch Alpha Vantage intelligence data for EARNINGS_CALL_TRANSCRIPT.

Official Alpha Vantage function: EARNINGS_CALL_TRANSCRIPT.';
    protected const REQUIRED = array (
  0 => 'symbol',
  1 => 'quarter',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Equity symbol.',
  ),
  'quarter' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fiscal quarter such as 2024Q1.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
