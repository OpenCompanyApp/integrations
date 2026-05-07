<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** List Sauce Connect tunnels. */
class SauceLabsListTunnels extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_list_tunnels'; protected const DESCRIPTION = 'List Sauce Connect tunnels for a username, defaulting to the configured username.'; protected const METHOD = 'listTunnels'; protected const ARGUMENTS = ['username']; protected const OPTIONAL = ['username']; }
