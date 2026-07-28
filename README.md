#  Sistema Bancario

Sistema Bancario desarrollado en **PHP** utilizando el patrón de arquitectura **MVC** y almacenamiento de información mediante archivos **JSON**.

---

#  Integrantes

- Juan Galvis
- Miguel Montenegro

---

#  Descripción

El proyecto permite administrar clientes, cuentas bancarias y transacciones financieras de una manera sencilla, aplicando el patrón Modelo-Vista-Controlador (MVC) y persistiendo la información en archivos JSON.

---

#  Funcionalidades

##  Gestión de Clientes

- Registrar clientes.
- Editar clientes.
- Eliminar clientes.
- Consultar clientes registrados.
- Validación de documento y correo duplicados.
- No permite eliminar clientes con cuentas asociadas.

---

##  Gestión de Cuentas

- Crear cuentas bancarias.
- Editar cuentas.
- Eliminar cuentas.
- Número de cuenta generado automáticamente.
- Validación de saldo inicial.
- Verificación de existencia del cliente.

---

##  Gestión de Transacciones

- Depósitos.
- Retiros.
- Transferencias.
- Historial de transacciones.

---

#  Validaciones implementadas

- Documento único.
- Correo único.
- Saldo inicial no negativo.
- La cuenta debe existir.
- La cuenta debe estar activa.
- Saldo suficiente para retiros.
- Saldo suficiente para transferencias.
- No se puede transferir a la misma cuenta.
- No se puede eliminar un cliente con cuentas asociadas.

---

#  Estructura del proyecto

```
Sistema-Bancario
│
├── config
│   └── JsonManager.php
│
├── controllers
│   ├── ClienteController.php
│   ├── CuentaController.php
│   └── TransaccionController.php
│
├── DB
│   ├── clientes.json
│   ├── cuentas.json
│   └── transacciones.json
│
├── models
│   ├── Cliente.php
│   ├── Cuenta.php
│   └── Transaccion.php
│
├── views
│   ├── clientes
│   ├── cuentas
│   ├── transacciones
│   └── layout
│       └── menu.php
│
├── index.php
└── README.md
```

---

#  Tecnologías utilizadas

- PHP 8
- HTML5
- CSS3
- JSON
- XAMPP
- Visual Studio Code
- Git
- GitHub

---

#  Instalación

1. Clonar el repositorio.

```
git clone https://github.com/JuanitoArt/Sistema-Bancario.git
```

2. Copiar el proyecto en la carpeta:

```
C:\xampp\htdocs\
```

3. Iniciar Apache desde XAMPP.

4. Abrir el navegador y acceder a:

```
http://localhost/Sistema-Bancario
```

---

#  Almacenamiento

La información del sistema se guarda en:

- DB/clientes.json
- DB/cuentas.json
- DB/transacciones.json

---

#  Arquitectura

El proyecto implementa el patrón de diseño **MVC (Modelo - Vista - Controlador)**.

- **Modelos:** gestionan la información.
- **Controladores:** contienen la lógica del negocio.
- **Vistas:** muestran la información al usuario.

---

#  Estado del proyecto

 Proyecto finalizado.

Todas las funcionalidades principales fueron implementadas y probadas correctamente.

---

#  Licencia

Proyecto desarrollado con fines académicos.