# Building Kartoza Lizmap Docker Image

This document describes how to build the Lizmap Web Client Docker image with Kartoza naming conventions.

## Prerequisites

- Docker installed and running
- Git (to clone the repository)

No local PHP, Composer, or npm installation is required - everything is built inside Docker containers.

## Quick Start

```bash
./build-docker.sh
```

This will build the Docker image tagged as `kartoza/lizmap-web-client:X.Y-dev` where X.Y is the short version (e.g., `3.8-dev`).

## Usage

### Development Build

```bash
./build-docker.sh
```

Creates image with `-dev` suffix:
- `kartoza/lizmap-web-client:3.8-dev`

### Release Build

```bash
./build-docker.sh --release
```

Creates images with version tags:
- `kartoza/lizmap-web-client:3.8.10` (full version)
- `kartoza/lizmap-web-client:3.8` (short version)
- `kartoza/lizmap-web-client:ltr-3.8` (if LTR release)

## Build Process

The script performs three main steps:

1. **Build Package** - Uses a Docker builder container to:
   - Install PHP dependencies via Composer
   - Install Node.js packages via npm
   - Build JavaScript assets
   - Create the distributable package

2. **Build Docker Image** - Builds the final Docker image using `docker/Dockerfile`

3. **Tag Image** - Tags the image with appropriate version tags

## Output

After a successful build, you'll see the built images:

```
Built images:
REPOSITORY                    TAG       IMAGE ID       CREATED          SIZE
kartoza/lizmap-web-client     3.8-dev   c8253eb51de9   2 minutes ago    181MB
```

## Pushing to Registry

After building, push the image to Docker Hub:

```bash
# Development build
docker push kartoza/lizmap-web-client:3.8-dev

# Release build (push all tags)
make docker-deliver REGISTRY_URL=kartoza DO_RELEASE=1
```

## Customization

### Change Registry Name

Edit `build-docker.sh` and modify the `REGISTRY_URL` variable:

```bash
REGISTRY_URL="your-registry"
```

### Version

The version is automatically extracted from `lizmap/project.xml`. To change it, edit that file:

```xml
<version date="2025-05-16">3.8.10</version>
```

## Troubleshooting

### Build fails with permission errors

Ensure Docker has proper permissions:
```bash
sudo usermod -aG docker $USER
# Then log out and back in
```

### Out of disk space

Clean up old Docker images and build artifacts:
```bash
make clean
docker system prune -a
```

### Builder container fails

Try rebuilding the builder image:
```bash
make -C dev builder
```

## Container Details

The built image contains:
- **Base**: Alpine Linux 3.17
- **PHP**: 8.1 with FPM
- **Lizmap**: Full web client application
- **Entry Point**: `/bin/lizmap-entrypoint.sh`

### Inspecting the Image

```bash
# Run interactive shell
docker run -it --rm --entrypoint /bin/sh kartoza/lizmap-web-client:3.8-dev

# Check version
docker run --rm --entrypoint /bin/sh kartoza/lizmap-web-client:3.8-dev -c "cat /www/VERSION"

# View build manifest
docker run --rm --entrypoint /bin/sh kartoza/lizmap-web-client:3.8-dev -c "cat /build.manifest"
```

## Related Files

- `build-docker.sh` - Main build script
- `docker/Dockerfile` - Production Dockerfile
- `dev/Dockerfile` - Builder container Dockerfile
- `dev/Makefile` - Builder container makefile
- `Makefile` - Main project makefile with Docker targets
