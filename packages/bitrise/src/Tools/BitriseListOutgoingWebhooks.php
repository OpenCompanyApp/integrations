<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List outgoing webhooks for a Bitrise app. */
class BitriseListOutgoingWebhooks extends AbstractBitriseTool { protected const NAME = 'bitrise_list_outgoing_webhooks'; protected const DESCRIPTION = 'List outgoing webhooks configured for a Bitrise app.'; protected const METHOD = 'listOutgoingWebhooks'; protected const ARGUMENTS = ['app_slug']; }
