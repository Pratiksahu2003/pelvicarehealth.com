# Run on your PC before uploading to Hostinger (no server terminal needed).
# Usage: .\scripts\deploy-hostinger.ps1

$ErrorActionPreference = "Stop"
$Root = Split-Path -Parent (Split-Path -Parent $MyInvocation.MyCommand.Path)
Set-Location $Root

Write-Host "==> Composer (production, no dev packages)..." -ForegroundColor Cyan
composer install --no-dev --optimize-autoloader

Write-Host "==> Frontend build (public/build)..." -ForegroundColor Cyan
if (-not (Test-Path "node_modules")) { npm ci }
npm run build

Write-Host "==> Removing local bootstrap/cache (do NOT upload Windows cache to Hostinger)..." -ForegroundColor Cyan
Get-ChildItem -Path "bootstrap\cache\*.php" -ErrorAction SilentlyContinue | Remove-Item -Force

Write-Host ""
Write-Host "Upload via hPanel File Manager or FTP:" -ForegroundColor Green
Write-Host "  - Entire project into public_html EXCEPT: node_modules, .git, tests (optional)"
Write-Host "  - Include: vendor/, public/build/, .env (create on server from .env.example)"
Write-Host "  - Document root: public_html/public"
Write-Host ""
Write-Host "On server .env set:" -ForegroundColor Green
Write-Host "  APP_ENV=production  APP_DEBUG=false  APP_URL=https://your-domain.com"
Write-Host "  DEPLOY_TOKEN=<long random string>"
Write-Host ""
Write-Host "Then open in browser (once):" -ForegroundColor Green
Write-Host "  https://your-domain.com/deploy/run?token=YOUR_DEPLOY_TOKEN"
Write-Host ""
Write-Host "Set folder permissions in hPanel (if site errors): storage/ and bootstrap/cache/ writable (755 or 775)." -ForegroundColor Yellow
