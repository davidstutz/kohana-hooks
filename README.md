# Hooks Kohana Module

An event module for Kohana.

# Usage

Let first make some general definitions. For this module a hook will be a simple unique string. Different subsystems of an application can register actions, meaning functions/methods, on all hooks. A hook must not be created, it will be created automatically by registering actions on it. All hooks can be fired throughout the program flow, meaning that all actions registered on that hook will be executed.

	$hook = 'logout';
	$method = 'Authentication::cleanup';

## Register an Action on Hooks

To register an action on a specific hook:

	Hooks::register($hook, $method, $args);
	
The registered method can expect one or more parameters. The parameters will be passed if the hook is fired merged with the in $args given parameters - the in $args given parameters are passed first.

## Get Registered Actions

To get an array of all registered methods on a specific hook:

	$array = Hooks::registered($hook);
	
The array is empty if no method is registered on the hook.

	if (!empty(Hooks::registered($hook)) {
		// Methods registered on $hook.
	}

## Fire Hooks

If a hook is fired all actions registered on this hook will be executed:

	Hooks::fire($hook, $parameters);
	
The parameters are passed as array, where the first entry of the array will be passed as first parameter and so on...

## License

Copyright (c) 2013, David Stutz
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
* Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
