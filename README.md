# CodeSurfing Development

[![Github all releases](https://img.shields.io/github/downloads/rioagungpurnomo/codesurfing/total.svg)](https://GitHub.com/rioagungpurnomo/codesurfing/releases/)
[![GitHub release](https://img.shields.io/github/release/rioagungpurnomo/codesurfing.svg)](https://GitHub.com/rioagungpurnomo/codesurfing/releases/)
[![GitHub stars](https://img.shields.io/github/stars/rioagungpurnomo/codesurfing.svg?style=social&label=Star&maxAge=2592000)](https://GitHub.com/rioagungpurnomo/codesurfing/stargazers/)
[![GitHub license](https://img.shields.io/github/license/rioagungpurnomo/codesurfing.svg)](https://github.com/rioagungpurnomo/codesurfing/blob/main/LICENSE)

# What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure. More information can be found at the [official site](https://codesurfing.com).

This repository holds the source code for CodeIgniter 4 only. Version 4 is a complete rewrite to bring the quality and the code into a more modern version, while still keeping as many of the things intact that has made people love the framework over the years.

# Documentation

The User Guide is the primary documentation for CodeSurfing.

The current in-progress User Guide can be found here. As with the rest of the framework, it is a work in progress, and will see changes over time to structure, explanations, etc.

# Important Change with index.php

index.php is no longer in the root of the project! It has been moved inside the main folder, for better security and separation of components.

This means that you should configure your web server to "point" to your project's main folder, and not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter main, as the rest of your logic and the framework are exposed.

Please read the user guide for a better explanation of how CS works!

# Contributors
Kami menerima kontribusi dari komunitas! Tidak masalah apakah Anda dapat membuat kode, menulis dokumentasi, atau membantu menemukan bug, semua kontribusi diterima.
![Your Repository's Stats](https://contrib.rocks/image?repo=rioagungpurnomo/codesurfing)
