<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Webhook Show tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutWebhookShow extends AbstractVboutOperationTool
{
    protected const OPERATION = 'webhook_show';
}