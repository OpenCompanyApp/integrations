<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List a historical log of item consent events.
 *
 * Maps to the official Plaid endpoint post /consent/events/get.
 */
class PlaidConsentEventsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_consent_events_get';
    protected const DESCRIPTION = 'List a historical log of item consent events

Official Plaid endpoint: POST /consent/events/get

List a historical log of Item consent events. Consent logs are only available for events occurring on or after November 7, 2024. Extremely recent events (occurring within the past 12 hours) may not be available via this endpoint. Up to three years of consent logs will be available via the endpoint.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/consent/events/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}