<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FetchGithubRepos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:github-repos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all GitHub repositories for user mkenyah and save to JSON file automatically using stored token.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = 'mkenyah';
        // Read token from environment variable or config for automatic fetching
        $token = env('GITHUB_TOKEN', null);
        if (!$token) {
            $this->error('GitHub token not found in environment variable GITHUB_TOKEN.');
            return 1;
        }

        $url = "https://api.github.com/user/repos?per_page=100";
        $repos = [];
        $page = 1;

        $this->info('Fetching GitHub repositories automatically using stored token...');

        do {
            $response = $this->fetchPage($url, $token);
            if ($response === false) {
                $this->error('Failed to fetch repositories from GitHub API.');
                return 1;
            }

            $data = json_decode($response['body'], true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error('Failed to parse JSON response.');
                return 1;
            }

            $repos = array_merge($repos, $data);

            // Check for next page
            $nextUrl = $this->getNextPageUrl($response['headers']);
            $url = $nextUrl;
            $page++;
        } while ($nextUrl);

        // Save to file
        $json = json_encode($repos, JSON_PRETTY_PRINT);
        Storage::put('mkenyah_repos.json', $json);

        $this->info("Fetched and saved " . count($repos) . " repositories to storage/app/mkenyah_repos.json");

        return 0;
    }

    private function fetchPage($url, $token = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Laravel-Artisan-Command/1.0');

        $headers = [
            'Accept: application/vnd.github.v3+json'
        ];

        if ($token) {
            $headers[] = 'Authorization: token ' . $token;
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return false;
        }

        // Split headers and body
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);

        return ['headers' => $headers, 'body' => $body];
    }

    private function getNextPageUrl($headers)
    {
        $lines = explode("\n", $headers);
        foreach ($lines as $line) {
            if (stripos($line, 'Link:') === 0) {
                $linkHeader = trim(substr($line, 5));
                $links = explode(',', $linkHeader);
                foreach ($links as $link) {
                    if (stripos($link, 'rel="next"') !== false) {
                        preg_match('/<([^>]+)>/', $link, $matches);
                        return $matches[1] ?? null;
                    }
                }
            }
        }
        return null;
    }
}
