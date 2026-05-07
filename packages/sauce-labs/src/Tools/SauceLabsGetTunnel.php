<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Get one Sauce Connect tunnel. */
class SauceLabsGetTunnel extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_get_tunnel'; protected const DESCRIPTION = 'Get one Sauce Connect tunnel.'; protected const METHOD = 'getTunnel'; protected const ARGUMENTS = ['username', 'tunnel_id']; }
