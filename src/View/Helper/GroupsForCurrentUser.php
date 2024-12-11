<?php

declare(strict_types=1);

namespace Group\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class GroupsForCurrentUser extends AbstractHelper
{
    /**
     * Used return list of groups for the current user.
     */
    public function __invoke(): array
    {
        $view = $this->getView();
        $user = $view->identity();
        if ($user) {
            $results = [];
            $groups = $view->api()->search('groups', ['user_id' => $user->getId()])->getContent();
            foreach ($groups as $group) {
                $results[$group->name()] = $group->id();
            }
            return $results;
        } else {
            return [];
        }
    }
}
