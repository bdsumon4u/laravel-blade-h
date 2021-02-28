<?php

namespace Hotash\BladeH\Compilers;

use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler as IlluminateBladeCompiler;
use Illuminate\View\Compilers\ComponentTagCompiler;

class BladeCompiler extends IlluminateBladeCompiler
{
    /**
     * The array of hotash component aliases and their class names.
     *
     * @var array
     */
    protected $hotashComponentAliases = [];

    /**
     * The array of hotash component namespaces to autoload from.
     *
     * @var array
     */
    protected $hotashComponentNamespaces = [];

    /**
     * Compile the component tags.
     *
     * @param  string  $value
     * @return string
     */
    protected function compileComponentTags($value)
    {
        if (! $this->compilesComponentTags) {
            return $value;
        }

        $value = (new HotashCompiler(
            $this->hotashComponentAliases, $this->hotashComponentNamespaces, $this
        ))->compile($value);

        return (new ComponentTagCompiler(
            $this->getClassComponentAliases(), $this->getClassComponentNamespaces(), $this
        ))->compile($value);
    }

    /**
     * Register a class-based hotash component alias directive.
     *
     * @param  string  $class
     * @param  string|null  $alias
     * @param  string  $prefix
     * @return void
     */
    public function hotash($class, $alias = null, $prefix = ''): void
    {
        if (! is_null($alias) && Str::contains($alias, '\\')) {
            [$class, $alias] = [$alias, $class];
        }

        if (is_null($alias)) {
            $alias = Str::contains($class, '\\View\\BladeH\\')
                ? collect(explode('\\', Str::after($class, '\\View\\BladeH\\')))->map(function ($segment) {
                    return Str::kebab($segment);
                })->implode(':')
                : Str::kebab(class_basename($class));
        }

        if (! empty($prefix)) {
            $alias = $prefix.'-'.$alias;
        }

        $this->hotashComponentAliases[$alias] = $class;
    }
}
