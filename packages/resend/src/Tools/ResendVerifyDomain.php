<?php

namespace OpenCompany\Integrations\Resend\Tools;

/**
 * Triggers verification of the domain's DNS records including DKIM, SPF, and the tracking CNAME if a tracking subdomain is configured.
 */
class ResendVerifyDomain extends AbstractResendOperationTool
{
    protected const TOOL_NAME = 'resend_verify_domain';
}
