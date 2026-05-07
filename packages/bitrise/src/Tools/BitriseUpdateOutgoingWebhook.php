<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Update an outgoing webhook for a Bitrise app. */
class BitriseUpdateOutgoingWebhook extends AbstractBitriseTool { protected const NAME = 'bitrise_update_outgoing_webhook'; protected const DESCRIPTION = 'Update an outgoing webhook for a Bitrise app.'; protected const METHOD = 'updateOutgoingWebhook'; protected const ARGUMENTS = ['app_slug', 'webhook_slug']; protected const REQUIRED = ['app_slug', 'webhook_slug', 'payload']; protected const USE_PAYLOAD = true; }
