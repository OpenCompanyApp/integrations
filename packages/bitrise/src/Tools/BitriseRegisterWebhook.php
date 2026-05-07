<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Register an incoming webhook for a Bitrise app. */
class BitriseRegisterWebhook extends AbstractBitriseTool { protected const NAME = 'bitrise_register_webhook'; protected const DESCRIPTION = 'Register an incoming webhook for a Bitrise app.'; protected const METHOD = 'registerWebhook'; protected const ARGUMENTS = ['app_slug']; protected const USE_PAYLOAD = true; }
