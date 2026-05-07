<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get dispute submitted arbitration evidence.
 *
 * Maps to the official Checkout.com endpoint GET /disputes/{dispute_id}/evidence/arbitration/submitted.
 */
class CheckoutComGetDisputeSubmittedArbitrationEvidence extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_dispute_submitted_arbitration_evidence';
    protected const DESCRIPTION = 'Retrieves the unique identifier of the PDF file containing all of the evidence submitted to escalate the dispute to arbitration. To retrieve the file\'s download link, call the `GET /files/{file_id}` [endpoint](https://api-reference.checkout.com/#operation/getFileInformation) with the returned file ID.

Official Checkout.com endpoint: GET /disputes/{dispute_id}/evidence/arbitration/submitted.';
    protected const PARAMETERS = [
        'dispute_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The dispute identifier.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/disputes/{dispute_id}/evidence/arbitration/submitted';
    protected const PATH_PARAMS = [
        'dispute_id' => 'dispute_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
