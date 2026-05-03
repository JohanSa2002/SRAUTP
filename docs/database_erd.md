# Diagrama Entidad-Relación (ERD) - Laravel UTP

Este documento describe la estructura de la base de datos del proyecto **laravelutp**.

## 1. Análisis de Entidades Principales

### Usuarios (`users`)
Representa a los estudiantes, asesores y administradores del sistema.
- **Campos clave**: `cedula`, `email`, `institutional_email`, `is_admin`, `is_advisor`.

### Artículos (`articles`)
Trabajos de investigación o proyectos subidos por los estudiantes.
- **Relaciones**:
    - Un artículo pertenece a un **Estudiante** (`user_id`).
    - Un artículo es revisado por un **Asesor** (`advisor_id`).
    - Un artículo puede estar vinculado a un **Evento** (`event_id`).

### Eventos (`events`)
Convocatorias o actividades académicas.
- **Relaciones**: Un evento puede tener múltiples artículos asociados.

### Recursos de Biblioteca (`library_resources`)
Documentos de apoyo y recursos digitales.

### Avisos (`notices`)
Comunicados y noticias del sistema.

---

## 2. Diagrama ER (Mermaid)

```mermaid
erDiagram
    USERS ||--o{ ARTICLES : "sube (estudiante)"
    USERS ||--o{ ARTICLES : "evalúa (asesor)"
    EVENTS ||--o{ ARTICLES : "contiene"
    
    USERS {
        bigint id PK
        string cedula UK
        string name
        string email UK
        string institutional_email UK
        string password
        boolean is_admin
        boolean is_advisor
        string profile_photo_path
        text description
        timestamp created_at
        timestamp updated_at
    }

    ARTICLES {
        bigint id PK
        string title
        string students
        integer year
        string career
        string pdf_path
        string status
        bigint user_id FK "Student ID"
        bigint advisor_id FK "Advisor ID"
        bigint event_id FK
        string event_category
        text comments
        timestamp created_at
        timestamp updated_at
    }

    EVENTS {
        bigint id PK
        string name
        text description
        string image_path
        date start_date
        date end_date
        json categories
        boolean is_active
        timestamp created_at
        timestamp updated_at
    }

    LIBRARY_RESOURCES {
        bigint id PK
        string title
        text description
        string file_path
        string category
        timestamp created_at
        timestamp updated_at
    }

    NOTICES {
        bigint id PK
        string title
        string summary
        text content
        string category
        string image_path
        boolean is_active
        timestamp created_at
        timestamp updated_at
    }
```

---

## 3. Detalle de Relaciones

1.  **Users -> Articles (1:N)**: Un usuario (estudiante) puede subir varios artículos. Un artículo solo pertenece a un estudiante.
2.  **Users -> Articles (1:N)**: Un usuario (asesor) puede evaluar varios artículos.
3.  **Events -> Articles (1:N)**: Un evento agrupa múltiples artículos presentados.
4.  **Library Resources & Notices**: Son entidades independientes que proporcionan información y recursos al sistema.

---

## 4. Consideraciones Técnicas
- **Soft Deletes**: Actualmente no se observan `deleted_at` en los modelos, se recomienda implementarlos para auditoría.
- **Integridad Referencial**: Los campos `user_id`, `advisor_id` y `event_id` en `articles` deben tener restricciones de clave foránea con `onDelete('cascade')` o `onDelete('set null')` según la lógica de negocio.
- **Categorías**: Los eventos usan un campo JSON para categorías, lo que ofrece flexibilidad pero dificulta las consultas complejas por categoría si el volumen de datos crece.
