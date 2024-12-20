<?php

namespace Modules\Base\Traits;

use Illuminate\Support\Collection;

trait CaslAbility {

    public function getCaslAbilityRules() :array
    {
        if ($this->is_superadmin)
            return [['action' => 'manage', 'subject' => 'all']];

        return $this->makeAbilityRules($this->getAllPermissions() , $this->id);
    }

    private function makeAbilityRules(Collection $permissions, string|int $user_id = null): array
    {
        $abilityRules = [];
        foreach ($permissions as $permission) {
            $name = $permission->name;
            if (str_contains($name, '-')) {
                [$action, $subject]= explode("-", $name, 2);

                $rule = ['action' => $action, 'subject' => $subject];

                if (str_contains($subject, 'own-') && $user_id !== null) {
                    $rule['conditions'] = ['user_id' => $user_id];
                }

                $abilityRules[] = $rule;

                $withoutOwnSubject = str_replace('own-', '', $subject);
                $abilityRules[] = ['action' => $action, 'subject' => "any:$withoutOwnSubject"];

                if (in_array($action, ['view', 'edit'])) {
                    $withoutOwnSubject_view = str_replace('trashed-', '', $subject);
                    $abilityRules[] = ['action' => $action, 'subject' => "any:$withoutOwnSubject_view"];

                    $withoutOwnSubject_view_own = str_replace('own-trashed-', '', $subject);
                    $abilityRules[] = ['action' => $action, 'subject' => "any:$withoutOwnSubject_view_own"];
                }
            }
        }

        $unique_combinations = [];
        $filteredAbilityRules = [];
        foreach ($abilityRules as $item) {
            $combination = $item['action'] . ':' . $item['subject'];
            if (!isset($unique_combinations[$combination])) {
                $filteredAbilityRules[] = $item;
                $unique_combinations[$combination] = true;
            }
        }
        return $filteredAbilityRules;
    }
}
