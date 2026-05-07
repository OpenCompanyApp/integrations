<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Review a Beacon User.
 *
 * Maps to the official Plaid endpoint post /beacon/user/review.
 */
class PlaidBeaconUserReview extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_user_review';
    protected const DESCRIPTION = 'Review a Beacon User

Official Plaid endpoint: POST /beacon/user/review

Update the status of a Beacon User. When updating a Beacon User\'s status via this endpoint, Plaid validates that the status change is consistent with the related state for this Beacon User. Specifically, we will check: 1. Whether there are any associated Beacon Reports connected to the Beacon User, and 2. Whether there are any confirmed Beacon Report Syndications connected to the Beacon User. When updating a Beacon User\'s status to `rejected`, we enforce that either a Beacon Report has been created for the Beacon User or a Beacon Report Syndication has been confirmed. When updating a Beacon User\'s status to `cleared`, we enforce that there are no active Beacon Reports or confirmed Beacon ...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/user/review';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}