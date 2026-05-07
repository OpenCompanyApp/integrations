<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * List all public breach data classes.
 */
class HaveIBeenPwnedDataClasses extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_data_classes';
    protected const DESCRIPTION = 'List all public breach data classes in alphabetical order.';
    protected const METHOD = 'dataClasses';
}
