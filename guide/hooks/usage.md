# Usage

Let first make some general definitions. For this module a hook will be a simple unique string. Different subsystems of an application can register actions, meaning functions/methods, on all hooks. A hook must not be created, it will be created automatically by registering actions on it. All hooks can be fired throughout the program flow, meaning that all actions registered on that hook will be executed.

	$hook = 'logout';
	$method = 'Authentication::cleanup';

## Register an Action on Hooks

To register an action on a specific hook:

	Hooks::register($hook, $method, $args);
	
The registered method can expect one or more parameters. The parameters will be passed if the hook is fired merged with the in $args given parameters.

## Get Registered Actions

To get an array of all registered methods on a specific hook:

	$array = Hooks::registered($hook);
	
The array is empty if no method is registered on the hook.

	if (!empty(Hooks::registered($hook))
	{
		// Methods registered on $hook.
	}

## Fire Hooks

If a hook is fired all actions registered on this hook will be executed:

	Hooks::fire($hook, $parameters);
	
The parameters are passed as array, where the first entry of the array will be passed as first parameter and so on...
