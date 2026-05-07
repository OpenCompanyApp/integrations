<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * add attachment to order.
 *
 * Maps to assessment-partner-api.json endpoint POST /orders/{orderId}/results/attachment.
 */
class SmartRecruitersAssessmentPartnerAddAttachmentToOrder extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_add_attachment_to_order";
    protected const DESCRIPTION = "add attachment to order\n\nOfficial SmartRecruiters endpoint: POST /orders/{orderId}/results/attachment from assessment-partner-api.json.";
    protected const PARAMETERS = [
        "order_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Order ID",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters assessment-partner-api.json schema for add attachment to order.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/assessment-api/v202010";
    protected const PATH = "/orders/{orderId}/results/attachment";
    protected const PATH_PARAMS = [
        "orderId" => "order_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "multipart";
    protected const AUTH_MODE = "either";
}
