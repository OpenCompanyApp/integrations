<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Register a new Bitrise app. */
class BitriseRegisterApp extends AbstractBitriseTool { protected const NAME = 'bitrise_register_app'; protected const DESCRIPTION = 'Register a new Bitrise app from repository details.'; protected const METHOD = 'registerApp'; protected const REQUIRED = ['payload']; protected const USE_PAYLOAD = true; }
