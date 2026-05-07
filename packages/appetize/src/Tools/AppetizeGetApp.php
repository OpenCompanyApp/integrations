<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** Get one Appetize app or app group. */
class AppetizeGetApp extends AbstractAppetizeTool { protected const NAME = 'appetize_get_app'; protected const DESCRIPTION = 'Get one Appetize app or app group by publicKey.'; protected const METHOD = 'getApp'; protected const ARGUMENTS = ['public_key']; }
