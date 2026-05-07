<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve the pdf reports associated with a relay token that was shared with you (beta).
 *
 * Maps to the official Plaid endpoint post /credit/relay/pdf/get.
 */
class PlaidCreditRelayPdfGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_relay_pdf_get';
    protected const DESCRIPTION = 'Retrieve the pdf reports associated with a relay token that was shared with you (beta)

Official Plaid endpoint: POST /credit/relay/pdf/get

`/credit/relay/pdf/get` allows third parties to receive a pdf report that was shared with them, using a `relay_token` that was created by the report owner. The `/credit/relay/pdf/get` endpoint retrieves the Asset Report in PDF format. Before calling `/credit/relay/pdf/get`, you must first create the Asset Report using `/credit/relay/create` and then wait for the [`PRODUCT_READY`](https://plaid.com/docs/api/products/assets/#product_ready) webhook to fire, indicating that the Report is ready to be retrieved. The response to `/credit/relay/pdf/get` is the PDF binary data. The `request_id` is returned in the `Plaid-Request-ID` header. [View a sample PDF Asset Report](https://plaid.com/documen...

This endpoint can return binary content such as PDF data. Non-JSON responses are returned as `{body, status}`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/relay/pdf/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}