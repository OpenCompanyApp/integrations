<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Stop one Sauce Connect tunnel. */
class SauceLabsStopTunnel extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_stop_tunnel'; protected const DESCRIPTION = 'Stop one Sauce Connect tunnel.'; protected const METHOD = 'stopTunnel'; protected const ARGUMENTS = ['username', 'tunnel_id']; }
