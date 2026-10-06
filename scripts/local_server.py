#!/usr/bin/env python3
"""
Local Development Server for AWS Student Portfolio
Supports running with PHP (if installed) or Python HTTP Server.
Usage:
    python scripts/local_server.py
"""

import os
import sys
import shutil
import subprocess
import http.server
import socketserver

PORT = 8000
WORKSPACE_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))

def run_php_server():
    print(f"[*] Found PHP runtime! Starting PHP built-in web server on http://localhost:{PORT}...")
    try:
        subprocess.run(['php', '-S', f'localhost:{PORT}'], cwd=WORKSPACE_DIR)
    except KeyboardInterrupt:
        print("\n[✓] Server stopped.")

def run_python_server():
    print(f"[*] PHP not detected in PATH. Starting Python static web server on http://localhost:{PORT}...")
    print(f"[*] Serving files from: {WORKSPACE_DIR}")
    print("[*] Note: For dynamic PHP execution (academic.php, skills.php), install PHP or deploy to Amazon EC2.")
    print("    Local static preview is fully active at: http://localhost:8000/index.html")

    os.chdir(WORKSPACE_DIR)
    Handler = http.server.SimpleHTTPRequestHandler
    with socketserver.TCPServer(("", PORT), Handler) as httpd:
        print(f"[✓] Local server live at: http://localhost:{PORT}")
        try:
            httpd.serve_forever()
        except KeyboardInterrupt:
            print("\n[✓] Server stopped.")

if __name__ == '__main__':
    if shutil.which('php'):
        run_php_server()
    else:
        run_python_server()
