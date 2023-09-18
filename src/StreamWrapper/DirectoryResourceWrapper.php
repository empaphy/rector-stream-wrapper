<?php

declare(strict_types=1);

namespace Empaphy\Indirector\StreamWrapper;

/**
 * @property-read resource $context is updated if a valid context is passed to the caller function.
 */
interface DirectoryResourceWrapper
{
    /**
     * Open directory handle.
     *
     * This method is called in response to {@see opendir()}.
     *
     * @param  string  $path     Specifies the URL that was passed to {@see opendir()}.
     *                           > **Note:**
     *                           > The URL can be broken apart with {@see parse_url()}.
     * @param  int     $options
     * @return bool `true` on success or `false` on failure.
     */
    public function dir_opendir(string $path, int $options): bool;

    /**
     * Close directory handle.
     *
     * This method is called in response to {@see closedir()}.
     *
     * Any resources which were locked, or allocated, during opening and use of the directory stream should be released.
     *
     * @return bool `true` on success or `false` on failure.
     */
    public function dir_closedir(): bool;

    /**
     * Read entry from directory handle.
     *
     * This method is called in response to {@see readdir()}.
     *
     * Emits {@see E_WARNING} if call to this method fails (i.e. not implemented).
     *
     * @return string|false Should return string representing the next filename, or `false` if there is no next file.
     */
    public function dir_readdir();

    /**
     * Rewind directory handle.
     *
     * This method is called in response to {@see rewinddir()}.
     *
     * Should reset the output generated by {@see static::dir_readdir()}. i.e.: The next call to
     * {@see static::dir_readdir()} should return the first entry in the location returned by
     * {@see static::dir_opendir()}.
     *
     * @return bool `true` on success or `false` on failure.
     */
    public function dir_rewinddir(): bool;

    /**
     * Create a directory.
     *
     * This method is called in response to {@see mkdir()}.
     *
     * > Note:
     * > In order for the appropriate error message to be returned this method should not be defined if the wrapper does
     * > not support creating directories.
     *
     * Emits {@see E_WARNING} if call to this method fails (i.e. not implemented).
     *
     * @param  string  $path     Directory which should be created.
     * @param  int     $mode     The value passed to {@see mkdir()}.
     * @param  int     $options  A bitwise mask of values, such as {@see STREAM_MKDIR_RECURSIVE}.
     * @return bool `true` on success or `false` on failure.
     */
    public function mkdir(string $path, int $mode, int $options): bool;

    /**
     * Removes a directory.
     *
     * This method is called in response to {@see rmdir()}.
     *
     * > Note:
     * > In order for the appropriate error message to be returned this method should not be defined if the wrapper does
     * > not support removing directories.
     *
     * Emits {@see E_WARNING} if call to this method fails (i.e. not implemented).
     *
     * @param  string  $path     The directory URL which should be removed.
     * @param  int     $options  A bitwise mask of values, such as {@see STREAM_MKDIR_RECURSIVE}.
     * @return bool `true` on success or `false` on failure.
     */
    public function rmdir(string $path, int $options): bool;
}
