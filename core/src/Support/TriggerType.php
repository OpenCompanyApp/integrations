<?php

namespace OpenCompany\IntegrationCore\Support;

enum TriggerType: string
{
    case Webhook = 'webhook';
    case Polling = 'polling';
}
