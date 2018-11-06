# Ifc2Gltf

WebIfc is a thin wrapper around [IfcOpenShell](http://ifcopenshell.org/ifcconvert.html) and [COLLADA2GLTF](https://github.com/KhronosGroup/COLLADA2GLTF) to provide a simple service to transparently convert [ifc](http://www.buildingsmart-tech.org/specifications/ifc-overview)- to [glTF](https://www.khronos.org/gltf/)-models.

## Quickstart

1. Clone repository:
    
    ```bash
    $ git clone https://github.com/RWTH-HTE-Formitas/Ifc2Gltf.git Ifc2Gltf
    $ cd Ifc2Gltf
    ```
 
1. Build the docker image to be accessible via the tag `ifc2gltf`:

    ```bash
    $ docker build -t ifc2gltf
    ```

1. Run service to be accessible under `http://localhost:8080/` with bind-mounted source for development:

    ```bash
    $ docker run -it -p 8080:80 -v "$(pwd)"/:/app ifc2gltf
    ```

## Usage

When the service runs there is an http endpoint which can be used to transparently convert an ifc file to a glTf file:

```bash
$ curl --output model.gltf http://localhost:8080/ifcToGltf?source=http://domain.tld/model.ifc
```
