$ErrorActionPreference = "Stop"

$port = 8000
$hostAddress = "127.0.0.1"
$projectRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$php = "C:\xampp\php\php.exe"

Write-Host "Checking port 8000..."
$connections = Get-NetTCPConnection -LocalPort $port -State Listen -ErrorAction SilentlyContinue

if ($connections) {
    $processIds = $connections | Select-Object -ExpandProperty OwningProcess -Unique

    foreach ($processId in $processIds) {
        $process = Get-Process -Id $processId -ErrorAction SilentlyContinue
        if ($process) {
            Write-Host "Stopping process $($process.ProcessName) ($processId) on port 8000..."
            Stop-Process -Id $processId -Force
        }
    }
}

Set-Location $projectRoot
& $php artisan optimize:clear

Write-Host "Starting this Laravel project on http://${hostAddress}:$port"
& $php artisan serve --host=$hostAddress --port=$port
