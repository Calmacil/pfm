<?php
/*
 *      default.php
 *
 *      Copyright 2010 Thomas Lenoël <thomas.lenoel@gmail.com>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */


    class defaultCtrl extends PwController {

        private function common() {
            $vue = $this->getView();

            $vue->addMetaEquiv('content-type', 'text/html; charset=UTF-8');

            return $vue;
        }

        public function index() {
			$vue = $this->common();
			$vue->setTemplate('index');

			$u = new PwUser();

			$u->login("togo", "togo");

		}

		public function error() {
			$vue = $this->common();
			$vue->setTemplate('error');

			$vue->render();
		}

		public function login() {
			$vue = $this->common();
			$vue->setTemplate('login');

			if ($this->isSession('USER')) {

				if (PwUser::hasCredential('write')) echo "oui";
				else echo "non";

			} else
				print "PAS BON";

			$vue->render();

		}

		public function logout() {
			$vue = $this->common();
			$vue->setTemplate('logout');
			$vue->render();

		}

    }

?>
