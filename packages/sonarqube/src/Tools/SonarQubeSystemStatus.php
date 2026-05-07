<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get state information about SonarQube.status: the running status - STARTING: SonarQube Web Server is up and serving some Web Services (eg. api/system/status) but initialization is still ongoing; - UP: SonarQube instance is up and running; - DOWN: SonarQube instance is up but not running because migration has failed (refer to WS /api/system/migrate_db for details) or some other reason (check logs).; - RESTARTING: SonarQube instance is still up but a restart has been requested (refer to WS /api/system/restart for details).; - DB_MIGRATION_NEEDED: database migration is required. DB migration can be started using WS /api/system/migrate_db.; - DB_MIGRATION_RUNNING: DB migration is running (refer to WS /api/system/migrate_db for details);.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/system/status.
 */
class SonarQubeSystemStatus extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_status';
    protected const DESCRIPTION = 'Get state information about SonarQube.status: the running status - STARTING: SonarQube Web Server is up and serving some Web Services (eg. api/system/status) but initialization is still ongoing; - UP: SonarQube instance is up and running; - DOWN: SonarQube instance is up but not running because migration has failed (refer to WS /api/system/migrate_db for details) or some other reason (check logs).; - RESTARTING: SonarQube instance is still up but a restart has been requested (refer to WS /api/system/restart for details).; - DB_MIGRATION_NEEDED: database migration is required. DB migration can be started using WS /api/system/migrate_db.; - DB_MIGRATION_RUNNING: DB migration is running (refer to WS /api/system/migrate_db for details);

Official SonarQube Web API endpoint: GET /api/system/status.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/system/status';
    protected const PARAM_MAP = array (
);
}
