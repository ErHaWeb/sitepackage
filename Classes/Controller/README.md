# Controller
## ActionController
Most Extbase controllers are based on the TYPO3\CMS\Extbase\Mvc\Controller\ActionController. It is theoretically possible to base a controller directly on the \TYPO3\CMS\Extbase\Mvc\Controller\ControllerInterface, however there are rarely use cases for that. Implementing the ControllerInterface does not guarantee a controller to be dispatchable. It is not recommended to base your controller directly on the ControllerInterface.

[Documentation](https://docs.typo3.org/m/typo3/reference-coreapi/11.5/en-us/ExtensionArchitecture/Extbase/Reference/Controller/ActionController.html)