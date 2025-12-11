#!/bin/bash
set -euo pipefail

APP_DIR=${APP_DIR:-/var/www/html}
PHP_LOG_DIR=/var/log/php
PERMS_MARKER=${PERMS_MARKER:-${APP_DIR}/.perms_set}
FORCE_PERMS=${FORCE_PERMS:-0}

mkdir -p "${PHP_LOG_DIR}"
chown www-data:www-data "${PHP_LOG_DIR}"

if [ -d "${APP_DIR}" ]; then
  if [ "${FORCE_PERMS}" = "1" ] || [ ! -f "${PERMS_MARKER}" ]; then
    chown -R www-data:www-data "${APP_DIR}"
    find "${APP_DIR}" -type d -exec chmod 755 {} \;
    find "${APP_DIR}" -type f -exec chmod 644 {} \;

    WRITABLE_DIRS=(
      bitrix/cache
      bitrix/managed_cache
      bitrix/stack_cache
      bitrix/tmp
      upload
    )

    for path in "${WRITABLE_DIRS[@]}"; do
      target="${APP_DIR}/${path}"
      if [ -d "${target}" ]; then
        chmod -R 775 "${target}"
      fi
    done

    touch "${PERMS_MARKER}"
  fi
fi

exec "$@"

