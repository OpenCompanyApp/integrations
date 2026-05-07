<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * AWS Marketplace fulfillment URL registration.
 *
 * Maps to the official LangSmith endpoint POST /aws-marketplace/register.
 */
class LangSmithPostAwsMarketplaceRegister extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_aws_marketplace_register';
    protected const DESCRIPTION = 'AWS Marketplace fulfillment URL registration

Official endpoint: POST /aws-marketplace/register
Receives the x-amzn-marketplace-token posted by AWS Marketplace when a customer clicks "Set Up Account", resolves the customer identity, fetches entitlements, stores both in the DB, and redirects to the thank-you page.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Multipart form fields. Use file_path for a local upload file when required.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/aws-marketplace/register';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
