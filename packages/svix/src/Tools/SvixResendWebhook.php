<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Resend Webhook using the official Svix API.
 */
class SvixResendWebhook extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message-attempt.resend';
}
