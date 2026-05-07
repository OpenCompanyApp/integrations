<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Create an outgoing webhook for a Bitrise app. */
class BitriseCreateOutgoingWebhook extends AbstractBitriseTool { protected const NAME = 'bitrise_create_outgoing_webhook'; protected const DESCRIPTION = 'Create an outgoing webhook for a Bitrise app.'; protected const METHOD = 'createOutgoingWebhook'; protected const ARGUMENTS = ['app_slug']; protected const REQUIRED = ['app_slug', 'payload']; protected const USE_PAYLOAD = true; }
