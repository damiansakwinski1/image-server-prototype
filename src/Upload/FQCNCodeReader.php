<?php

declare(strict_types=1);

namespace App\Upload;

class FQCNCodeReader
{
    public function read(string $code): FQCNResult
    {
        $tokens = token_get_all($code);
        $namespace = $this->getNamespaceFromTokens($tokens);
        $className = $this->getClassNameFromTokens($tokens);

        return new FQCNResult($className, $namespace);
    }

    /**
     * @param array<int, array<int, int|string>|string> $tokens
     */
    private function getNamespaceFromTokens(array $tokens): string
    {
        foreach ($tokens as $token) {
            [$index, $content] = $token;

            if (T_NAME_QUALIFIED === $index) {
                return trim((string) $content);
            }
        }

        return '';
    }

    /**
     * @param array<int, array<int, int|string>|string> $tokens
     */
    private function getClassNameFromTokens(array $tokens): string
    {
        foreach ($tokens as $token) {
            [$index, $content, $line] = $token;

            if (T_CLASS === $index) {
                return $this->getClassNameFromTokenLine($tokens, (int) $line);
            }
        }

        return '';
    }

    /**
     * @param array<int, array<int, int|string>|string> $tokens
     */
    private function getClassNameFromTokenLine(array $tokens, int $lineToSearch): string
    {
        $tokensFromSuppliedLine = array_filter($tokens, fn (array|string $token) => ($token[2] ?? -1) === $lineToSearch);

        foreach ($tokensFromSuppliedLine as $token) {
            [$index, $content] = $token;

            if (T_STRING === $index) {
                return trim((string) $content);
            }
        }

        return '';
    }
}
