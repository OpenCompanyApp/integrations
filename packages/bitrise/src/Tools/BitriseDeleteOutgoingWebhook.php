<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Delete an outgoing webhook for a Bitrise app. */
class BitriseDeleteOutgoingWebhook extends AbstractBitriseTool { protected const NAME = 'bitrise_delete_outgoing_webhook'; protected const DESCRIPTION = 'Delete an outgoing webhook for a Bitrise app.'; protected const METHOD = 'deleteOutgoingWebhook'; protected const ARGUMENTS = ['app_slug', 'webhook_slug']; }
