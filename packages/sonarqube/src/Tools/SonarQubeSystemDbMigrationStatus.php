<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Display the database migration status of SonarQube. State values are:- NO_MIGRATION: DB is up to date with current version of SonarQube.; - NOT_SUPPORTED: Migration is not supported on embedded databases.; - MIGRATION_RUNNING: DB migration is under go.; - MIGRATION_SUCCEEDED: DB migration has run and has been successful.; - MIGRATION_FAILED: DB migration has run and failed. SonarQube must be restarted in order to retry a DB migration (optionally after DB has been restored from backup).; - MIGRATION_REQUIRED: DB migration is required.;.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/system/db_migration_status.
 */
class SonarQubeSystemDbMigrationStatus extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_db_migration_status';
    protected const DESCRIPTION = 'Display the database migration status of SonarQube. State values are:- NO_MIGRATION: DB is up to date with current version of SonarQube.; - NOT_SUPPORTED: Migration is not supported on embedded databases.; - MIGRATION_RUNNING: DB migration is under go.; - MIGRATION_SUCCEEDED: DB migration has run and has been successful.; - MIGRATION_FAILED: DB migration has run and failed. SonarQube must be restarted in order to retry a DB migration (optionally after DB has been restored from backup).; - MIGRATION_REQUIRED: DB migration is required.;

Official SonarQube Web API endpoint: GET /api/system/db_migration_status.

Deprecated since SonarQube 10.6; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/system/db_migration_status';
    protected const PARAM_MAP = array (
);
}
