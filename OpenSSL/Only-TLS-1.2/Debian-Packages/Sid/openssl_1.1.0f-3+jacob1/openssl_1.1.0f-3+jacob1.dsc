-----BEGIN PGP SIGNED MESSAGE-----
Hash: SHA256

Format: 3.0 (quilt)
Source: openssl
Binary: openssl, libssl1.1, libcrypto1.1-udeb, libssl1.1-udeb, libssl-dev, libssl-doc
Architecture: any all
Version: 1.1.0f-3+jacob1
Maintainer: Debian OpenSSL Team <pkg-openssl-devel@lists.alioth.debian.org>
Uploaders: Christoph Martin <christoph.martin@uni-mainz.de>, Kurt Roeckx <kurt@roeckx.be>, Sebastian Andrzej Siewior <sebastian@breakpoint.cc>
Homepage: https://www.openssl.org/
Standards-Version: 3.9.8
Vcs-Browser: https://anonscm.debian.org/viewvc/pkg-openssl/openssl
Vcs-Svn: svn://anonscm.debian.org/pkg-openssl/openssl/
Build-Depends: debhelper (>= 10), m4, bc, dpkg-dev (>= 1.15.7)
Package-List:
 libcrypto1.1-udeb udeb debian-installer optional arch=any
 libssl-dev deb libdevel optional arch=any
 libssl-doc deb doc optional arch=all
 libssl1.1 deb libs important arch=any
 libssl1.1-udeb udeb debian-installer optional arch=any
 openssl deb utils optional arch=any
Checksums-Sha1:
 9e3e02bc8b4965477a7a1d33be1249299a9deb15 5278176 openssl_1.1.0f.orig.tar.gz
 15b129da44fd33fbd6411639a720c1d0feb44d0b 59760 openssl_1.1.0f-3+jacob1.debian.tar.xz
Checksums-Sha256:
 12f746f3f2493b2f39da7ecf63d7ee19c6ac9ec6a4fcd8c229da8a522cb12765 5278176 openssl_1.1.0f.orig.tar.gz
 058da629b6d1105524bbfe14f1fc90a1d974ac7f3d81e0f01e27c6e2bcf69952 59760 openssl_1.1.0f-3+jacob1.debian.tar.xz
Files:
 7b521dea79ab159e8ec879d2333369fa 5278176 openssl_1.1.0f.orig.tar.gz
 c26ecb1121158cefb5545dcd17a97c65 59760 openssl_1.1.0f-3+jacob1.debian.tar.xz

-----BEGIN PGP SIGNATURE-----

iQIzBAEBCAAdFiEEzW53hyB08Y/nbOzkComqYqx0xjQFAlt08IgACgkQComqYqx0
xjRqtA//exik+enm+q8/khbYn/lCBFsa+y3PDK+VsJTBNozR1osBJOPNAbwbUUUd
WKYz5a1mG/JL3VCSLBY58qzWrhgYW8ln2zw00CGApPkb4mUS8pV2+c2Bl6yp+G/b
OvkDf4adp1xHfBxoj8tPLVQRJCcqOnng9ze+XoF1O6QK9y4vkhSEGSo6weUCJvfA
xN+9r7an64p3O8i2ONef11qkXo9mO11nQ8mQolTElTinGvUjLMY/TBzHO1gnFTFr
DgyJs9lgmu972DyKM/IioC1Kdc8swgV/hQ7TYLcKxb81yAybZ2ah3oTEZ2NuqhBy
vgkC1APvCaA9cZUdwXChbA8jd6iw+N6CgTZjf/51uAn56je97XojghYDZBuDPofh
pASVoAMEepr4yGTuvNPVG6WoGPi6EP7zc5BZYfV7KjyJAiHXqkSzpJcp/OupK8bV
R/DgMH4g/qAR5Z4Zqf+JBiumkN8ds8odZjhkTWhCEW9W0VIht1GoORnif1TyNDoR
t5ScmnoWp0mcZtrwuJR39QEXzL2ugrcfSz1FW7xqjWFExQjqfjLz/qPD0jVwYpKK
oNwUxjcavtzyxrJCgHnbArnEVgoIbErXFiVJx0GomSW7aVNvNt9O3q7THB2FaIR9
UCLnlrkKPKJff/ko0F+OTg29nK/C2rPmUELpBmdgg8SkqeFyuaM=
=cY0N
-----END PGP SIGNATURE-----
